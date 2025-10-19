<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentAccountCreated;
use App\Models\Student;

class TestStudentEmail extends Command
{
    protected $signature = 'test:student-email {student_id}';
    protected $description = 'Test sending student account creation email';

    public function handle()
    {
        $studentId = $this->argument('student_id');
        $student = Student::find($studentId);

        if (!$student) {
            $this->error("Student with ID {$studentId} not found.");
            return 1;
        }

        try {
            Mail::to($student->email)->send(new StudentAccountCreated(
                $student,
                'testusername',
                'testpassword123',
                'test.student@cdd.edu.ph'
            ));

            $this->info("Test email sent successfully to {$student->email}");
            return 0;
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
            return 1;
        }
    }
}