<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;

class StudentAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $username;
    public $password;
    public $studentEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student, string $username, string $password, string $studentEmail)
    {
        $this->student = $student;
        $this->username = $username;
        $this->password = $password;
        $this->studentEmail = $studentEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Congratulations! You are now a Student Assistant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.student-account-created',
            text: 'emails.student-account-created'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}