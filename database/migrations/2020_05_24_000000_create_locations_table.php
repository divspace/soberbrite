<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('state_id')->unsigned();
            $table->char('zip_code', 5)->unique();
            $table->string('city');
            $table->point('coordinate');
            $table->time('timezone_offset');
            $table->boolean('observes_dst')->default(1);
            $table->timestamps();

            $table->index(['zip_code', 'city', 'state_id']);
            $table->spatialIndex('coordinate');

            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
}
