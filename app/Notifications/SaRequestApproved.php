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
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('SA Request Approved')
                    ->line('Your Student Assistant request has been approved!')
                    ->line('Office: ' . $this->saRequest->office)
                    ->line('A student has been assigned to your office.')
                    ->line('Thank you for using the SA Request system!');
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
            'message' => 'Your SA request for ' . $this->saRequest->office . ' has been approved and a student has been assigned.',
            'type' => 'sa_request_approved'
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'sa_request_id' => $this->saRequest->id,
            'office' => $this->saRequest->office,
            'message' => 'Your SA request for ' . $this->saRequest->office . ' has been approved and a student has been assigned.',
            'type' => 'sa_request_approved'
        ];
    }
}