<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('id_number', 50);
            $table->string('name')->nullable();
            $table->enum('action', ['in', 'out']);
            $table->timestamp('clock_time');
            $table->timestamps();
            $table->index(['id_number', 'clock_time']);
            $table->index('clock_time');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
