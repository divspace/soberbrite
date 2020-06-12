<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    public function up(): void
    {
        Schema::create('programs', static function (Blueprint $table): void {
            $table->tinyIncrements('id');
            $table->tinyInteger('program_type_id')->unsigned();
            $table->string('name')->unique();
            $table->string('abbreviation')->nullable();
            $table->timestamps();

            $table->foreign('program_type_id')->references('id')->on('program_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
}
