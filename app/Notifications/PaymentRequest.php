<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRequest extends Notification implements ShouldQueue
{
    use Queueable;

    private Order $order;
    private string $greeting;
    private string $salutation;
    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, string $greeting, string $salutation)
    {
        $this->order = $order;
        $this->greeting = $greeting;
        $this->salutation = $salutation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Payment request Bill of Lading')
            ->markdown('payment-request.notification', [
                'greeting' => $this->greeting,
                'order' => $this->order,
                'salutation' => $this->salutation
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
