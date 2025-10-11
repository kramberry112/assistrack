<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->boolean('is_literate')->nullable();
            $table->json('tools')->nullable();
            $table->boolean('can_commit')->nullable();
            $table->boolean('willing_overtime')->nullable();
            $table->boolean('comfortable_clerical')->nullable();
            $table->boolean('strong_communication')->nullable();
            $table->boolean('willing_training')->nullable();
            $table->string('other_skills')->nullable();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'is_literate',
                'tools',
                'can_commit',
                'willing_overtime',
                'comfortable_clerical',
                'strong_communication',
                'willing_training',
                'other_skills'
            ]);
        });
    }
};
