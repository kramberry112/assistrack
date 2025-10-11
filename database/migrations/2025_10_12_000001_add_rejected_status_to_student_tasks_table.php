<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('student_tasks', function (Blueprint $table) {
            $table->enum('status', ['todo', 'in_progress', 'completed', 'rejected'])->default('todo')->change();
        });
    }
    public function down() {
        Schema::table('student_tasks', function (Blueprint $table) {
            $table->enum('status', ['todo', 'in_progress', 'completed'])->default('todo')->change();
        });
    }
};
