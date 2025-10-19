<?php
/*
 * Simple test script to demonstrate email functionality
 * Run this with: php artisan tinker < test_email_demo.php
 */

// Get a student without an account
$student = App\Models\Student::whereNull('user_id')->first();

if (!$student) {
    echo "No students found without accounts. Creating a test student...\n";
    $student = App\Models\Student::create([
        'student_name' => 'Test Student',
        'course' => 'Computer Science',
        'year_level' => '3rd Year',
        'id_number' => 'TEST-2025-001',
        'age' => 20,
        'address' => '123 Test Street, Dagupan City',
        'email' => 'test.student@example.com',
        'telephone' => '09123456789',
        'designated_office' => 'IT Office'
    ]);
    echo "Test student created: {$student->student_name}\n";
} else {
    echo "Found student: {$student->student_name} (ID: {$student->id})\n";
}

// Demonstrate the email functionality
echo "Student email: {$student->email}\n";
echo "Designated office: {$student->designated_office}\n";

// Test the Mailable class
$username = 'testuser';
$password = 'testpass123';
$studentEmail = 'testuser.stud@cdd.edu.ph';

$mailable = new App\Mail\StudentAccountCreated($student, $username, $password, $studentEmail);

echo "\nEmail would be sent to: {$student->email}\n";
echo "With credentials:\n";
echo "- Username: {$username}\n";
echo "- Password: {$password}\n";
echo "- Student Email: {$studentEmail}\n";
echo "- Office: {$student->designated_office}\n";

echo "\nEmail functionality is ready to use!\n";