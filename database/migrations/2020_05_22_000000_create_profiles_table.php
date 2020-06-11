<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    private const USER = 'user_id';

    public function up(): void
    {
        Schema::create('profiles', static function (Blueprint $table): void {
            $table->uuid('id');
            $table->uuid(self::USER);
            $table->string('username', 50)->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->char('phone', 10)->nullable();
            $table->char('gender', 1)->nullable();
            $table->date('birth_date')->nullable();
            $table->date('sobriety_date');
            $table->timestamps();

            $table->foreign(self::USER)->references('id')->on('users');

            $table->primary(['id', self::USER]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
}
