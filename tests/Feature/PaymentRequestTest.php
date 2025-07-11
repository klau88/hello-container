<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Notifications\PaymentRequest;
use App\Observers\OrderObserver;
use App\Services\NotificationMailService;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PaymentRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test sending a notification mail from payment request containing order data to email address
     *
     * @return void
     */
    public function test_sending_notification_mail_from_payment_request(): void
    {
        Notification::fake();

        $email = config('order.email');

        $order = Order::factory()->create(['freight_payer_self' => false]);

        $this->app->make(NotificationMailService::class)->send($order, $email);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            PaymentRequest::class,
            function (PaymentRequest $notification, array $channels, $notifiable) use ($email, $order) {
                $mail = $notification->toMail($notifiable);

                return in_array('mail', $channels)
                    && $notifiable->routeNotificationFor('mail') === $email
                    && $mail->subject === 'Payment request Bill of Lading'
                    && str_contains($mail->render(), (string)$order->bl_release_date)
                    && str_contains($mail->render(), (string)$order->bl_release_user_id)
                    && str_contains($mail->render(), (string)$order->freight_payer_self)
                    && str_contains($mail->render(), (string)$order->bl_number)
                    && str_contains($mail->render(), (string)$order->contract_number);
            }
        );
    }

    /**
     * Test notification is sent on demand on order save during office hours
     * @return void
     */
    public function test_notification_sent_on_demand_on_order_save_during_office_hours(): void
    {
        Notification::fake();

        Carbon::setTestNow(Carbon::parse('2025-07-04 12:00:00'));

        $order = Order::factory()->create(['freight_payer_self' => false]);

        $this->app->make(OrderObserver::class)->saved($order);

        Notification::assertSentOnDemand(PaymentRequest::class, function (PaymentRequest $notification, $channels, $notifiable) use ($order) {
            return $notifiable->routes['mail'] === config('order.email');
        });

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            PaymentRequest::class,
            function ($notification, $channels, $notifiable) use ($order) {
                $mail = $notification->toMail($notifiable);
                return $notifiable->routes['mail'] === config('order.email')
                    && $mail->subject === 'Payment request Bill of Lading'
                    && str_contains($mail->render(), (string)$order->bl_release_date)
                    && str_contains($mail->render(), (string)$order->bl_release_user_id)
                    && str_contains($mail->render(), (string)$order->freight_payer_self)
                    && str_contains($mail->render(), (string)$order->bl_number)
                    && str_contains($mail->render(), (string)$order->contract_number);
            }
        );

        $this->assertTrue($order->fresh()->notification_sent);
    }

    /**
     * Test notification is delayed outside of office hours
     * @return void
     */
    public function test_notification_is_delayed_order_save_outside_office_hours(): void
    {
        Queue::fake();

        Carbon::setTestNow(Carbon::parse('2025-07-05 12:00:00')); // Saturday 12 PM

        $order = Order::factory()->create(['freight_payer_self' => false]);

        $order->touch();

        $this->assertEquals(
            '2025-07-05 12:00:00',
            Carbon::now()->toDateTimeString()
        );

        Queue::assertPushed(SendQueuedNotifications::class, function ($job) {
            $expected = Carbon::parse('2025-07-07 09:00:00');
            return $job->delay->eq($expected);
        });

        Carbon::setTestNow();
    }
}
