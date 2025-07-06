<?php

namespace App\Services;

use App\Models\Order;
use App\Notifications\PaymentRequest;
use Illuminate\Notifications\AnonymousNotifiable;

class NotificationMailService
{
    /**
     * @param Order $order
     * @param string $email
     * @return void
     */
    public function send(Order $order, string $email): void
    {
        $greeting = 'Payment request Bill of Lading';
        $salutation = 'With kind regards,<br>HelloContainer';

        $paymentRequest = new PaymentRequest($order, $greeting, $salutation);

        $notifiable = new AnonymousNotifiable();
        $notifiable->route('mail', $email)->notify($paymentRequest);

        $paymentRequest->toMail($notifiable);
    }
}
