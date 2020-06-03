<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table): void {
            $table->uuid('id');
            $table->tinyInteger('program_type_id')->unsigned();
            $table->string('name')->unique();
            $table->string('abbreviation')->nullable();
            $table->timestamps();

            $table->primary(['id', 'program_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
}
