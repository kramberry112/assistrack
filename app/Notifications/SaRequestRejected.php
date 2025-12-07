<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\SaRequest;

class SaRequestRejected extends Notification
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
        $mail = (new MailMessage)
                    ->subject('SA Request Status Update')
                    ->line('We regret to inform you that your Student Assistant request has not been approved at this time.')
                    ->line('Office: ' . $this->saRequest->office);
                    
        if ($this->saRequest->reason) {
            $mail->line('Reason: ' . $this->saRequest->reason);
        }
        
        return $mail->line('You may reapply in the future when positions become available.')
                   ->line('Thank you for your interest in becoming a Student Assistant.');
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
            'reason' => $this->saRequest->reason,
            'message' => 'Your SA request for ' . $this->saRequest->office . ' has been rejected.',
            'type' => 'sa_request_rejected'
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'sa_request_id' => $this->saRequest->id,
            'office' => $this->saRequest->office,
            'reason' => $this->saRequest->reason,
            'message' => 'Your SA request for ' . $this->saRequest->office . ' has been rejected.',
            'type' => 'sa_request_rejected'
        ];
    }
}