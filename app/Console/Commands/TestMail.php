<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Exception;

class TestMail extends Command
{
    protected $signature = 'test:mail {email}';
    protected $description = 'Test email configuration';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing email configuration...");
        $this->info("Sending test email to: {$email}");
        
        try {
            Mail::raw('This is a test email from AssisTrack system.', function ($message) use ($email) {
                $message->to($email)
                        ->subject('AssisTrack - Test Email');
            });
            
            $this->info("✅ Email sent successfully!");
            return 0;
            
        } catch (Exception $e) {
            $this->error("❌ Email failed to send:");
            $this->error("Error: " . $e->getMessage());
            
            // Additional debugging info
            $this->info("\nCurrent mail configuration:");
            $this->info("MAIL_MAILER: " . config('mail.default'));
            $this->info("MAIL_HOST: " . config('mail.mailers.smtp.host'));
            $this->info("MAIL_PORT: " . config('mail.mailers.smtp.port'));
            $this->info("MAIL_USERNAME: " . config('mail.mailers.smtp.username'));
            $this->info("MAIL_FROM_ADDRESS: " . config('mail.from.address'));
            
            return 1;
        }
    }
}