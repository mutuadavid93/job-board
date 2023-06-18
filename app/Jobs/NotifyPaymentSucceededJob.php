<?php

namespace App\Jobs;



/*
|--------------------------------------------------------------------------
| This ia Queued Job
|--------------------------------------------------------------------------
|
| SerializesModels Trait ::
| Eloquent models and their loaded relationships will be gracefully serialized and
| unserialized when the job is processing.
|
*/


use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifyPaymentSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected string $session_id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // NOTE: In production use `supervisord` to run the workers
        $order = Order::where('session_id', $this->session_id)->first();
        if ($order && $order->status === 'unpaid') {
            $order->status = 'paid';
            $order->save();
            // Send email to customer
        }
    }
}
