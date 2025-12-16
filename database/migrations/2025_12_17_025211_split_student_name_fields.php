<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add missing columns to students table
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'last_name')) {
                $table->string('last_name')->after('id')->nullable();
            }
            if (!Schema::hasColumn('students', 'first_name')) {
                $table->string('first_name')->after('last_name')->nullable();
            }
            if (!Schema::hasColumn('students', 'middle_name')) {
                $table->string('middle_name')->after('first_name')->nullable();
            }
        });

        // Migrate existing data in students only if student_name column exists
        if (Schema::hasColumn('students', 'student_name')) {
            DB::table('students')->get()->each(function ($student) {
                if ($student->student_name) {
                    $nameParts = explode(' ', trim($student->student_name));
                    $lastName = array_shift($nameParts) ?? '';
                    $firstName = array_shift($nameParts) ?? '';
                    $middleName = implode(' ', $nameParts);

                    DB::table('students')
                        ->where('id', $student->id)
                        ->update([
                            'last_name' => $lastName,
                            'first_name' => $firstName,
                            'middle_name' => $middleName ?: null,
                        ]);
                }
            });

            // Drop old student_name column from students
            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn('student_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore students table
        Schema::table('students', function (Blueprint $table) {
            $table->string('student_name')->after('id')->nullable();
        });

        // Restore data in students
        DB::table('students')->get()->each(function ($student) {
            $fullName = trim(
                ($student->last_name ?? '') . ' ' . 
                ($student->first_name ?? '') . ' ' . 
                ($student->middle_name ?? '')
            );
            
            DB::table('students')
                ->where('id', $student->id)
                ->update(['student_name' => $fullName]);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'first_name', 'middle_name']);
        });
    }
};
