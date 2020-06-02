<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaCodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('area_codes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->tinyInteger('state_id')->unsigned();
            $table->smallInteger('code')->unsigned()->unique();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_codes');
    }
}
