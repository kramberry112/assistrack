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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('evaluator_id')->constrained('users')->onDelete('cascade');
            $table->string('department');
            
            // Work Skills ratings
            $table->integer('problem_solving')->nullable();
            $table->integer('writing_skills')->nullable();
            $table->integer('oral_communication')->nullable();
            $table->integer('adaptability')->nullable();
            $table->integer('service')->nullable();
            $table->integer('attention_to_detail')->nullable();
            $table->integer('attitude')->nullable();
            
            // Work Attributes ratings (can be 1-5 or N/A)
            $table->string('interpersonal_communication', 10)->nullable();
            $table->string('creativity', 10)->nullable();
            $table->string('confidentiality', 10)->nullable();
            $table->string('initiative', 10)->nullable();
            $table->string('teamwork', 10)->nullable();
            $table->string('dependability', 10)->nullable();
            $table->string('punctuality', 10)->nullable();
            $table->string('making_use_of_time_wisely', 10)->nullable();
            
            // Comments
            $table->text('overall_comments')->nullable();
            
            // Metadata
            $table->timestamp('submitted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
