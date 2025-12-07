<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Application;

class NewApplicationSubmitted extends Notification
{
    use Queueable;

    protected $application;

    /**
     * Create a new notification instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];  // Removed 'mail' channel
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Application Submitted')
                    ->line('A new applicant has submitted an application.')
                    ->line('Student Name: ' . $this->application->student_name)
                    ->line('Course: ' . $this->application->course)
                    ->line('Year Level: ' . ($this->application->year_level ?? 'Not specified'))
                    ->line('Email: ' . ($this->application->email ?? 'Not provided'))
                    ->action('Review Application', url('/admin/applicants'))
                    ->line('Please review the application in the admin panel.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'NewApplicationSubmitted',
            'application_id' => $this->application->id,
            'student_name' => $this->application->student_name,
            'course' => $this->application->course,
            'message' => 'New application from ' . $this->application->student_name,
        ];
    }
}
