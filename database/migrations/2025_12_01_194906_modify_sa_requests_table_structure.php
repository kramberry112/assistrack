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
        Schema::table('sa_requests', function (Blueprint $table) {
            // Remove student_id foreign key constraint and column
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
            
            // Add new fields for department SA request
            $table->text('description')->after('office'); // Description of help needed
            $table->integer('requested_count')->default(1)->after('description'); // Number of SAs needed
            $table->foreignId('assigned_student_id')->nullable()->after('requested_count')->constrained('students')->onDelete('set null'); // Student assigned by admin
            $table->timestamp('assigned_at')->nullable()->after('assigned_student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sa_requests', function (Blueprint $table) {
            // Restore original structure
            $table->dropForeign(['assigned_student_id']);
            $table->dropColumn(['description', 'requested_count', 'assigned_student_id', 'assigned_at']);
            $table->foreignId('student_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
};
