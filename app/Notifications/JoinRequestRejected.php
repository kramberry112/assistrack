<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JoinRequestRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $groupName;

    public function __construct($groupName)
    {
        $this->groupName = $groupName;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Community Group Join Request Rejected')
            ->line('Your request to join the group "' . $this->groupName . '" was rejected.')
            ->line('If you have questions, please contact the group owner.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'group_name' => $this->groupName,
            'message' => 'Your request to join the group "' . $this->groupName . '" was rejected.'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'group_name' => $this->groupName,
            'message' => 'Your request to join the group "' . $this->groupName . '" was rejected.'
        ];
    }

    // Optionally, add toDatabase or toBroadcast methods
}
