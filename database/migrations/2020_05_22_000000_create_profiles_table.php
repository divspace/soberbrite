<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->foreignId('user_id');
            $table->string('username')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->char('phone', 10)->nullable();
            $table->enum('gender', ['male', 'female', 'custom'])->nullable();
            $table->date('birth_date')->nullable();
            $table->date('sobriety_date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
}
