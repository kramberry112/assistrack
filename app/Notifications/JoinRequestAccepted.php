<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JoinRequestAccepted extends Notification
{

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
            ->subject('Community Group Join Request Accepted')
            ->line('Your request to join the group "' . $this->groupName . '" was accepted!')
            ->line('You are now a member of the group and can participate in group activities.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'group_name' => $this->groupName,
            'message' => 'Your request to join the group "' . $this->groupName . '" was accepted!',
            'type' => 'join_request_accepted'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'group_name' => $this->groupName,
            'message' => 'Your request to join the group "' . $this->groupName . '" was accepted!',
            'type' => 'join_request_accepted'
        ];
    }
}