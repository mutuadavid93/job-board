<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Inertia\Inertia;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Jobs\NotifyPaymentSucceededJob;
use App\Models\{Order, Company, Joblisting, Enhancement};
use App\Http\Requests\{UpdateJoblistingRequest, StoreJoblistingRequest};
use Symfony\Component\HttpKernel\Exception\{HttpException, NotFoundHttpException};
use Carbon\Carbon;

class JoblistingController extends Controller
{
    public function index()
    {
        return Inertia::render('Jobs');
    }

    public function show(Joblisting $joblisting)
    {
        // Load the related company data when returning the joblisting payload
        $joblisting->load('company');

        return Inertia::render("JoblistingDetails", ["joblisting" => $joblisting]);
    }

    public function edit(Joblisting $joblisting)
    {
        $joblisting->load("company");
        return Inertia::render("EditJoblisting", ["joblisting" => $joblisting]);
    }

    public function update(UpdateJoblistingRequest $request, Joblisting $joblisting)
    {
        $validatedData = $request->validated();
        // Find or create a Company instance;
        // If found, return the Company instance without creating a new one.
        $company = $this->saveCompany($request);
        $validatedData['company_id'] = $company->id;

        // Remove the company-related fields from the validated data
        unset($validatedData['name']);
        unset($validatedData['overview']);
        unset($validatedData['email']);

        // Handle the company logo using your ImageService class
        if ($request->hasFile('logo')) {
            $imageService = new ImageService();
            $company = $imageService->updateImage($company, $request);
            // Save the updated company instance
            $company->save();
        }

        // Refrain logo column from $joblisting table
        unset($validatedData['logo']);

        // Update the job listing with the validated data
        $joblisting->update($validatedData);
        return Inertia::render("EditJoblisting", ["joblisting" => $joblisting]);
    }

    public function displayJobs()
    {
        // $joblistings = Joblisting::with("enhancements")->get();
        // Get all joblistings with their related enhancements and company data
        $joblistings = Joblisting::with(["enhancements", "company", "tags"])->get();
        $distinctTags = Tag::select('name')->distinct()->get();
        // $oldJobs = $this->getOldJobs();

        return Inertia::render('Home', [
            "joblistings" => $joblistings,
            "commontags" => $distinctTags,
            // "oldJobs" => $oldJobs,
        ]);
    }

    public function store(StoreJoblistingRequest $request)
    {
        $validatedData = $request->validated();

        // Extract the tag IDs from the payload
        $createdTags = $this->createTags($request);

        // Return key-value pairs from the first array whose keys are not present in the other arrays.
        // i.e. remove company fields from $validatedData
        $companyFields = ['name', 'logo', 'overview', 'email'];
        $validatedData = array_diff_key($validatedData, array_flip($companyFields));
        // $validatedData = array_diff($validatedData, array_flip($request));

        // Enhancements' validations:
        $createdEnhancements = $this->validateEnhancements($request);

        // HINT: user id is only available when a user is authenticated
        $validatedData['user_id'] = $request->user()->id;

        $company = $this->saveCompany($request);
        // Relate Company to Joblisting
        $validatedData['company_id'] = $company->id;

        // Create a new Joblisting and save it
        $joblisting = Joblisting::create($validatedData);

        // Insert into pivot table
        $joblisting->enhancements()->attach($createdEnhancements);
        $joblisting->tags()->attach($createdTags);

        // Make payment
        $enhancements = $joblisting->enhancements()->get();
        $url = $this->makeOrder($enhancements, (int) $request->total);
        return Inertia::location($url);
        // return Inertia::render('Jobs');
    }

    public function createTags(Request $request)
    {
        $createdTags = [];
        $tags = $request->input('tags', []);
        foreach ($tags as $tag) {
            // dd($tag['name']);
            $tag = Tag::create(["name" => $tag['name']]);
            $createdTags[] = $tag->id;
        }
        return $createdTags;
    }

    public function getOldJobs()
    {
        $daysAgo = 30;
        $dateThreshold = Carbon::now()->subDays($daysAgo);

        $oldJobs = Joblisting::where('created_at', '<', $dateThreshold)->get();
        return $oldJobs;
    }

    public function saveCompany(Request $request)
    {
        // Create or find a Company instance
        $company = Company::firstOrCreate(
            ['name' => $request->input('name')],
            [
                'overview' => $request->input("overview"),
                'email' => $request->input('email')
            ]
        );

        // update logo
        $company = (new ImageService)->updateImage($company, $request);
        $company->save(); // Save the updated company instance

        return $company;
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

            return Inertia::render("ThankYou", [
                "message" => "Job posted successfully.",
                "appreciation" => "Thanks, {$customer->name}! Your job posting and payment were successful."
            ]);
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
