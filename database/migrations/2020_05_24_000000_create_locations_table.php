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
            $table->char('zip_code', 5)->unique();
            $table->string('city');
            $table->char('state', 2);
            $table->point('coordinate');
            $table->time('timezone_offset');
            $table->boolean('observes_dst')->default(1);
            $table->timestamps();

            $table->index(['zip_code', 'city', 'state']);
            $table->spatialIndex('coordinate');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
}
