<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->integer('city_id')->unsigned();
            $table->tinyInteger('state_id')->unsigned();
            $table->smallInteger('zip_code_id')->unsigned();
            $table->point('coordinate');
            $table->time('timezone_offset');
            $table->boolean('observes_dst')->default(1);
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('zip_code_id')->references('id')->on('zip_codes');

            $table->unique(['city_id', 'state_id', 'zip_code_id']);
            $table->spatialIndex('coordinate');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
}
