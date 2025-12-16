<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskVerifiedNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $studentName;

    public function __construct($task, $studentName)
    {
        $this->task = $task;
        $this->studentName = $studentName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You verified "' . $this->task->title . '" for ' . $this->studentName,
            'task_id' => $this->task->id,
            'student_name' => $this->studentName,
            'task_title' => $this->task->title,
        ];
    }
}
