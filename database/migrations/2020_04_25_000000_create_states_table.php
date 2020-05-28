<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->char('code', 2)->unique();
            $table->string('name', 20)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('states');
    }
}
