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
        // Add foreign key constraint for user_id in students table (do not add column)
        Schema::table('students', function (Blueprint $table) {
            if (\Schema::hasColumn('students', 'user_id')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
        });

        // Add student_id and admin_id to applications table
        Schema::table('applications', function (Blueprint $table) {
            if (!\Schema::hasColumn('applications', 'student_id')) {
                $table->unsignedBigInteger('student_id')->nullable()->after('id');
            }
            if (!\Schema::hasColumn('applications', 'admin_id')) {
                $table->unsignedBigInteger('admin_id')->nullable()->after('student_id');
            }
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove foreign key from students table
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Remove foreign keys and columns from applications table
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['admin_id']);
            if (\Schema::hasColumn('applications', 'student_id')) {
                $table->dropColumn('student_id');
            }
            if (\Schema::hasColumn('applications', 'admin_id')) {
                $table->dropColumn('admin_id');
            }
        });
    }
};
