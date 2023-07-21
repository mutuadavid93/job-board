<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Stripe\StripeClient;
use App\Models\Joblisting;
use App\Models\Enhancement;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Jobs\NotifyPaymentSucceededJob;
use App\Http\Requests\StoreJoblistingRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JoblistingController extends Controller
{
    public function index()
    {
        return Inertia::render('Jobs');
    }

    public function show(Joblisting $joblisting)
    {
        return Inertia::render("JoblistingDetails", ["joblisting" => $joblisting]);
    }

    public function edit(Joblisting $joblisting)
    {
        return Inertia::render("EditJoblisting", ["joblisting" => $joblisting]);
    }

    public function update(StoreJoblistingRequest $request, Joblisting $joblisting)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('company_logo')) {
            $imageService = new ImageService();
            $joblisting = $imageService->updateImage($joblisting, $request);
            // Remove the company_logo key from the $validatedData. Since is already set in ImageService
            // NOTE: otherwise it will be ovewritten by request from browser i.e. $validatedData['company_logo']
            unset($validatedData['company_logo']);
        } else {
            $validatedData['company_logo'] = '/images/nologo.svg';
        }

        // Update the job listing with the validated data
        $joblisting->update($validatedData);
        return Inertia::render("EditJoblisting", ["joblisting" => $joblisting]);
    }

    public function displayJobs()
    {
        // Get all job_listings in descending order, orderedBy `created_at` field
        $joblistings = Joblisting::with("enhancements")->get();

        return Inertia::render('Home', ["joblistings" => $joblistings]);
    }

    // TIP: &$validatedData is a pointer to the actual $validatedData argument. 
    // Thus changes to it will be effected to store's actual object.
    private function handleCompanyLogo(Request $request, &$validatedData)
    {
        if ($request->hasFile('company_logo')) {
            $imageService = new ImageService();
            $joblisting = new Joblisting($validatedData);
            $joblisting = $imageService->updateImage($joblisting, $request);
            $validatedData['company_logo'] = $joblisting->company_logo;
        } else {
            $validatedData['company_logo'] = '/images/nologo.svg';
        }
    }

    public function store(StoreJoblistingRequest $request)
    {
        $validatedData = $request->validated();

        $companyOverview = $validatedData['company_overview'];
        $jobPurpose = $validatedData['job_purpose'];
        $responsibilities = $validatedData['responsibilities'];
        $professionalSkills = $validatedData['professional_skills'];

        // Enhancements' validations:
        $createdEnhancements = $this->validateEnhancements($request);

        $validatedData['title'] = $request->input('title');
        $validatedData['company_name'] = $request->input('company_name');
        $validatedData['company_overview'] = $request->input('company_overview');
        $validatedData['job_purpose'] = $request->input('job_purpose');
        $validatedData['professional_skills'] = $request->input('professional_skills');
        $validatedData['employment_type'] = $request->input('employment_type');
        $validatedData['location'] = $request->input('location');
        $validatedData['salary'] = $request->input('salary');
        $validatedData['experience_level'] = $request->input('experience_level');

        $validatedData['company_overview'] = $companyOverview;
        $validatedData['job_purpose'] = $jobPurpose;
        $validatedData['professional_skills'] = $professionalSkills;
        $validatedData['responsibilities'] = $responsibilities;

        // Handle company logo
        $this->handleCompanyLogo($request, $validatedData);

        // Create a new Joblisting and save it
        $joblisting = Joblisting::create($validatedData);

        // Insert into pivot table
        $joblisting->enhancements()->attach($createdEnhancements);

        // Make payment
        $enhancements = $joblisting->enhancements()->get();
        $url = $this->makeOrder($enhancements, (int) $request->total);
        // return Inertia::location($url);
        return redirect()->route('home');
    }

    public function validateEnhancements(StoreJoblistingRequest $request)
    {
        $enhancementInvalid = "Invalid enhancement amount";
        if (!empty($request->logo_present) && $request->logo_present != 49) {
            throw new HttpException(403, $enhancementInvalid);
        }
        if (!empty($request->list_highlighted) && $request->list_highlighted != 399) {
            throw new HttpException(403, $enhancementInvalid);
        }
        if (!empty($request->listing_boosted) && $request->listing_boosted != 1499) {
            throw new HttpException(403, $enhancementInvalid);
        }
        if (!empty($request->custom_color_price) && $request->custom_color_price != 49) {
            throw new HttpException(403, $enhancementInvalid);
        }

        $createdEnhancements = [];
        $enhancements = $request->input('enhancements');
        foreach ($enhancements as $enhancementData) {
            $enhancement = Enhancement::create($enhancementData);
            $createdEnhancements[] = $enhancement->id; // Store only the enhancement ID
        }
        return $createdEnhancements;
    }

    public function makeOrder($enhancements, $total_price)
    {
        $lineItems = [];
        $stripe = new StripeClient(config("app.stripe_secret_key"));
        foreach ($enhancements as $enhancement) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $enhancement->type,
                    ],
                    'unit_amount' => $enhancement->price * 100,
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
        Order::create([
            // TODO: refactor to enums
            "status" => "unpaid",
            "total_price" => $total_price,
            "session_id" => $checkout_session->id
        ]);
        return $checkout_session->url;
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
                echo "Seems like this order was paid. Redirectly you to home page.";
                sleep(3);
                // throw new NotFoundHttpException();
                return redirect()->route('home');
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
