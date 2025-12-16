<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Add new columns
            $table->string('last_name')->nullable()->after('id');
            $table->string('first_name')->nullable()->after('last_name');
            $table->string('middle_name')->nullable()->after('first_name');
        });

        // Migrate existing data if needed
        DB::table('applications')->get()->each(function ($application) {
            if ($application->student_name) {
                // Try to split the name (basic split by space)
                $nameParts = explode(' ', trim($application->student_name));
                
                DB::table('applications')
                    ->where('id', $application->id)
                    ->update([
                        'last_name' => $nameParts[0] ?? '',
                        'first_name' => $nameParts[1] ?? '',
                        'middle_name' => $nameParts[2] ?? '',
                    ]);
            }
        });

        // Drop the old column
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('student_name');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Add back the old column
            $table->string('student_name')->nullable()->after('id');
        });

        // Migrate data back
        DB::table('applications')->get()->each(function ($application) {
            $fullName = trim(($application->last_name ?? '') . ' ' . ($application->first_name ?? '') . ' ' . ($application->middle_name ?? ''));
            
            DB::table('applications')
                ->where('id', $application->id)
                ->update(['student_name' => $fullName]);
        });

        // Drop the new columns
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'first_name', 'middle_name']);
        });
    }
};
