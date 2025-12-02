<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\SaRequest;

class SaRequestApproved extends Notification
{
    use Queueable;

    protected $saRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(SaRequest $saRequest)
    {
        $this->saRequest = $saRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('SA Request Approved')
                    ->line('Note: This notification is deprecated and should not be used.')
                    ->line('Office: ' . $this->saRequest->office);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'sa_request_id' => $this->saRequest->id,
            'office' => $this->saRequest->office,
            'message' => 'Deprecated notification',
            'type' => 'sa_request_approved'
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'sa_request_id' => $this->saRequest->id,
            'office' => $this->saRequest->office,
            'message' => 'Deprecated notification',
            'type' => 'sa_request_approved'
        ];
    }
}