<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('grades', function (Blueprint $table) {
            $table->string('student_name')->nullable();
            $table->string('year_level')->nullable();
            $table->string('semester')->nullable();
            $table->json('subjects')->nullable();
            $table->string('proof_url')->nullable();
        });
    }
    public function down() {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn(['student_name', 'year_level', 'semester', 'subjects', 'proof_url']);
        });
    }
};
