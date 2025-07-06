<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\PaymentRequestService;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class OrderObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Order "saved" event.
     */
    public function saved(Order $order): void
    {
        app()->make(PaymentRequestService::class)->process($order);
    }
}
