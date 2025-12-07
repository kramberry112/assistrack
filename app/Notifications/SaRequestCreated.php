<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\SaRequest;

class SaRequestCreated extends Notification
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
                    ->subject('New SA Help Request Submitted')
                    ->line('A department has requested Student Assistant help.')
                    ->line('Office: ' . $this->saRequest->office)
                    ->line('Requested SAs: ' . $this->saRequest->requested_count)
                    ->line('Description: ' . $this->saRequest->description)
                    ->action('Assign Student Assistant', url('/admin/sa-requests'))
                    ->line('Please find and assign an available student assistant to help this department.');
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
            'requested_count' => $this->saRequest->requested_count,
            'description' => $this->saRequest->description,
            'message' => $this->saRequest->office . ' is requesting ' . $this->saRequest->requested_count . ' Student Assistant(s)',
            'type' => 'sa_request_created'
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'sa_request_id' => $this->saRequest->id,
            'office' => $this->saRequest->office,
            'requested_count' => $this->saRequest->requested_count,
            'description' => $this->saRequest->description,
            'message' => $this->saRequest->office . ' is requesting ' . $this->saRequest->requested_count . ' Student Assistant(s)',
            'type' => 'sa_request_created'
        ];
    }
}