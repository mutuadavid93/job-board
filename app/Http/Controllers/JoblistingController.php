<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Stripe\StripeClient;
use App\Models\Joblisting;
use App\Models\Enhancement;
use Illuminate\Http\Request;
use App\Jobs\NotifyPaymentSucceededJob;
use App\Http\Requests\StoreJoblistingRequest;
use App\Http\Resources\AllJoblistingsCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JoblistingController extends Controller
{
    public function index()
    {
        $tinymce = env("TinyMCE_API_KEY");
        return Inertia::render('Jobs', ["tinymce" => $tinymce]);
    }

    public function displayJobs()
    {
        // Get all job_listings in descending order, orderedBy `created_at` field
        $joblistings = Joblisting::with("enhancements")->get();

        return Inertia::render('Home', ["joblistings" => $joblistings]);
    }

    public function store(StoreJoblistingRequest $request)
    {
        $id = rand(1, 100);
        // Retrieve the validated data
        $validatedData = $request->validated();

        $validatedData['title'] = $request->input('title');
        $validatedData['company_name'] = $request->input('company_name');
        $validatedData['description'] = $request->input('description');
        $validatedData['employment_type'] = $request->input('employment_type');
        $validatedData['location'] = $request->input('location');
        $validatedData['salary'] = $request->input('salary');
        $validatedData['experience_level'] = $request->input('experience_level');
        // Overwrite the 'company_logo' key with a new value
        $validatedData['company_logo'] = "https://picsum.photos/id/{$id}/200/300";

        // Create a new Joblisting instance and save it
        $joblisting = Joblisting::create($validatedData);
        // dd($validatedData);

        // Attach enhancements
        $enhancements = Enhancement::inRandomOrder()->get();
        $joblisting->enhancements()->attach($enhancements);

        return redirect()->route('home');
    }

    public function checkout()
    {
        $jobs = Joblisting::all();
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
