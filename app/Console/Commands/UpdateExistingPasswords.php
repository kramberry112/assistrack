<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateExistingPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing users with readable passwords for admin view';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::whereNull('plain_password')->get();
        
        foreach ($users as $user) {
            if ($user->role === 'student') {
                $user->plain_password = 'assistrack2025';
                $user->save();
                $this->info("Updated student: {$user->username}");
            } else {
                // For existing admin/head_office users, set a default password
                $defaultPassword = 'admin2025'; // You can change this
                $user->plain_password = $defaultPassword;
                $user->password = bcrypt($defaultPassword); // Also update the actual password
                $user->save();
                $this->info("Updated {$user->role}: {$user->username} with password: {$defaultPassword}");
            }
        }
        
        $this->info("Updated {$users->count()} users with readable passwords.");
    }
}
