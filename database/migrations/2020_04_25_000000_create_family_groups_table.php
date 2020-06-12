<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyGroupsTable extends Migration
{
    public function up(): void
    {
        Schema::create('family_groups', static function (Blueprint $table): void {
            $table->tinyIncrements('id');
            $table->string('name')->unique();
            $table->string('abbreviation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_groups');
    }
}
