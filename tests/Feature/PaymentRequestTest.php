<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Notifications\PaymentRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PaymentRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test sending a notification mail from payment request containing order data to email address
     *
     * @return void
     */
    public function test_sending_notification_mail_from_payment_request()
    {
        Notification::fake();

        $email = config('order.email');

        $order = Order::factory()->create();
        $greeting = 'Payment request Bill of Lading';
        $salutation = 'With kind regards,<br>HelloContainer';

        $paymentRequest = new PaymentRequest($order, $greeting, $salutation);

        $notifiable = new AnonymousNotifiable();
        $notifiable->route('mail', $email)->notify($paymentRequest);

        $mailMessage = $paymentRequest->toMail($notifiable);

        Notification::assertSentTo(
            $notifiable,
            PaymentRequest::class,
            function (PaymentRequest $notification, array $channels, $notifiable) use ($mailMessage, $email, $order) {
                $mail = $notification->toMail($notifiable);

                return in_array('mail', $channels)
                    && $notifiable->routeNotificationFor('mail') === $email
                    && $mail->subject === 'Payment request Bill of Lading'
                    && str_contains($mail->render(), $mailMessage->render())
                    && str_contains($mail->render(), (string)$order->bl_release_date)
                    && str_contains($mail->render(), (string)$order->bl_release_user_id)
                    && str_contains($mail->render(), (string)$order->freight_payer_self)
                    && str_contains($mail->render(), (string)$order->bl_number)
                    && str_contains($mail->render(), (string)$order->contract_number);
            }
        );
    }
}
