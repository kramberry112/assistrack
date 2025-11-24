<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Populate foreign keys for grades table
        $grades = DB::table('grades')->whereNull('student_id')->get();
        foreach ($grades as $grade) {
            // Try to find student by name
            $student = DB::table('students')->where('student_name', $grade->student_name)->first();
            if ($student) {
                DB::table('grades')
                    ->where('id', $grade->id)
                    ->update([
                        'student_id' => $student->id,
                        'user_id' => $student->user_id
                    ]);
            }
        }

        // Populate foreign keys for attendances table
        $attendances = DB::table('attendances')->whereNull('student_id')->get();
        foreach ($attendances as $attendance) {
            // Try to find student by id_number
            $student = DB::table('students')->where('id_number', $attendance->id_number)->first();
            if ($student) {
                DB::table('attendances')
                    ->where('id', $attendance->id)
                    ->update([
                        'student_id' => $student->id,
                        'user_id' => $student->user_id
                    ]);
            } else {
                // If no student found by id_number, try by name
                $student = DB::table('students')->where('student_name', $attendance->name)->first();
                if ($student) {
                    DB::table('attendances')
                        ->where('id', $attendance->id)
                        ->update([
                            'student_id' => $student->id,
                            'user_id' => $student->user_id
                        ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset foreign key columns to null
        DB::table('grades')->update(['student_id' => null, 'user_id' => null]);
        DB::table('attendances')->update(['student_id' => null, 'user_id' => null]);
    }
};
