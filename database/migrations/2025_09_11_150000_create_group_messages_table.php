<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_group_id')->constrained('community_groups')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('group_messages');
    }
};
