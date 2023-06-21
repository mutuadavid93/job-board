<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobListingRequest;
use App\Http\Resources\AllJobListingsCollection;
use App\Jobs\NotifyPaymentSucceededJob;
use Inertia\Inertia;
use App\Models\Order;
use Stripe\StripeClient;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JobListingController extends Controller
{
    public function index()
    {
        $tinymce = env("TinyMCE_API_KEY");
        return Inertia::render('Jobs', ["tinymce" => $tinymce]);
    }

    public function displayJobs()
    {
        // Get all job_listings in descending order, orderedBy `created_at` field
        $jobListings = JobListing::latest("created_at")->get();

        // Pass the job_listings through the resource collection.
        // TIP: Brings back a joblisting and it's associated items e.g. company, category e.t.c
        $jobListingResource = new AllJobListingsCollection($jobListings);

        return Inertia::render('Home', ["joblistings" => $jobListingResource]);
    }

    public function store(StoreJobListingRequest $request)
    {
        // The request has already been validated at this point
        // Retrieve the validated data using $request->validated()
        $data = $request->validated();

        // category Data


        // company Data
        // location Data
        // Store Job Data

        dd($data);
        // return redirect()->route('jobs.index');
    }

    public function checkout()
    {
        $jobs = JobListing::all();
        $lineItems = [];
        $lineItems = [];
        $total_price = 0;
        $stripe = new StripeClient(config("app.stripe_secret_key"));

        foreach ($jobs as $job) {
            $total_price += $job->salary;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $job->title,
                    ],
                    'unit_amount' => $job->salary * 100,
                ],
                'quantity' => 1,
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route("checkout.cancel", [], true),
        ]);

        // Save the sessionID in Database. This will be used to continue the payment
        Order::create([
            // TODO: refactor to enums
            "status" => "unpaid",
            "total_price" => $total_price,
            "session_id" => $checkout_session->id
        ]);

        // return Inertia::render("Checkout", ["jobs" => $jobs]);
        return Inertia::location($checkout_session->url);
    }

    public function success(Request $request)
    {
        $stripe = new StripeClient(config("app.stripe_secret_key"));
        // Get request 
        $sessionID = $request->input("session_id");

        try {
            $session = $stripe->checkout->sessions->retrieve($sessionID);

            if (!$session) {
                throw new NotFoundHttpException();
            }
            // HINT: customer doesn't work for some reason it's null
            // Thus I grabbed the customer_details instead.
            $customer = $session->customer_details;
            // $customer = \Stripe\Customer::retrieve($session->customer);

            if (!$customer) {
                throw new NotFoundHttpException();
            }

            // Retrieve that Exact order from Database
            $order = Order::where('session_id', $session->id)->where("status", "unpaid")->first();

            if (!$order) {
                throw new NotFoundHttpException();
            }

            $order->status = "paid";
            $order->save();
            return Inertia::render("CheckoutSuccess", ["customer" => $customer]);
        } catch (\Throwable $e) {
            throw new NotFoundHttpException();
        }
    }


    // TODO: Refactor into a que later
    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = config("app.webhook_secret");

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                // NOTE: This needs computer time to be correct to work
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                NotifyPaymentSucceededJob::dispatch($session->id);
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
