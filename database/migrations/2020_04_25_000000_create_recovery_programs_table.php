<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoveryProgramsTable extends Migration
{
    public function up(): void
    {
        Schema::create('recovery_programs', static function (Blueprint $table): void {
            $table->tinyIncrements('id');
            $table->string('name')->unique();
            $table->string('abbreviation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recovery_programs');
    }
}
