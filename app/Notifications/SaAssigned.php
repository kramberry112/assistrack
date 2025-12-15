<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\SaRequest;

class SaAssigned extends Notification
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
                    ->subject('You Have Been Assigned as Student Assistant')
                    ->line('Congratulations! You have been assigned as a Student Assistant.')
                    ->line('Office: ' . $this->saRequest->office)
                    ->line('Assignment Description: ' . $this->saRequest->description)
                    ->line('Please report to the office for your SA duties.')
                    ->line('Thank you for your service as a Student Assistant!');
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
            'description' => $this->saRequest->description,
            'message' => 'You have been temporarily assigned as Student Assistant for ' . $this->saRequest->office,
            'type' => 'sa_assigned'
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'sa_request_id' => $this->saRequest->id,
            'office' => $this->saRequest->office,
            'description' => $this->saRequest->description,
            'message' => 'You have been assigned as Student Assistant for ' . $this->saRequest->office,
            'type' => 'sa_assigned'
        ];
    }
}