<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\PaymentRequest;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Log;

class OrderObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Order "saved" event.
     */
    public function saved(Order $order): void
    {
        if ($order->freight_payer_self || $order->notification_sent) {
            return;
        }

        $greeting = 'Payment request Bill of Lading';
        $salutation = 'With kind regards,<br>HelloContainer';

        $paymentRequest = new PaymentRequest($order, $greeting, $salutation);

        $now = Carbon::now();

        // Return if not office hours
        if (!($now->isWeekday() && ($now->hour >= 9 && $now->hour <= 17))) {
            $delayUntil = $now->copy()->nextWeekday()->setHour(9)->setMinute(0)->setSecond(0);
            $paymentRequest->delay($delayUntil);
        }

        $email = config('order.email');

        try {
            $notifiable = new AnonymousNotifiable();
            $notifiable->route('mail', $email)->notify($paymentRequest);

            $order->updateQuietly(['notification_sent' => true]);
        } catch (\Throwable $e) {
            Log::error('Failed to send PaymentRequest notification.', [
                'order_id' => $order->id,
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
