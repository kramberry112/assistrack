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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('student_name');
            $table->string('course');
            $table->string('year_level')->nullable();
            $table->string('age')->nullable();
            $table->string('id_number')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('picture')->nullable();

            // Family Background
            $table->string('father_name')->nullable();
            $table->string('father_age')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_age')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('monthly_income')->nullable();

            // Computer Literacy
            $table->boolean('is_literate')->default(false);
            $table->json('tools')->nullable();

            // Commitment & Skills
            $table->boolean('can_commit')->default(false);
            $table->boolean('willing_overtime')->default(false);
            $table->boolean('comfortable_clerical')->default(false);
            $table->boolean('strong_communication')->default(false);
            $table->boolean('willing_training')->default(false);
            $table->text('other_skills')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
