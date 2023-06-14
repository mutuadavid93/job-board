<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Inertia\Inertia;
use App\Models\Order;
use Stripe\StripeClient;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }


    public function checkout()
    {
        $jobs = Job::all();
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
            'success_url' => route("checkout.success", [], true),
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

    public function success(): void
    {
        # code...
    }
}
