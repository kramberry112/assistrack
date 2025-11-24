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
        // Add foreign key relationships to grades table
        Schema::table('grades', function (Blueprint $table) {
            // Add student_id column to link to students table
            $table->unsignedBigInteger('student_id')->nullable()->after('id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            
            // Add user_id column to link to users table
            $table->unsignedBigInteger('user_id')->nullable()->after('student_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Add index for better performance
            $table->index(['student_id', 'semester', 'year_level']);
        });

        // Add foreign key relationships to attendances table
        Schema::table('attendances', function (Blueprint $table) {
            // Add student_id column to link to students table
            $table->unsignedBigInteger('student_id')->nullable()->after('id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            
            // Add user_id column to link to users table  
            $table->unsignedBigInteger('user_id')->nullable()->after('student_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Add indexes for better performance
            $table->index(['student_id', 'clock_time']);
            $table->index(['user_id', 'clock_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['student_id', 'semester', 'year_level']);
            $table->dropColumn(['student_id', 'user_id']);
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['student_id', 'clock_time']);
            $table->dropIndex(['user_id', 'clock_time']);
            $table->dropColumn(['student_id', 'user_id']);
        });
    }
};
