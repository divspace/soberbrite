<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->id();
            $table->char('zip', 5);
            $table->string('city');
            $table->char('state', 2);
            $table->point('coordinate');
            $table->time('timezone_offset');
            $table->boolean('has_dst')->default(1);
            $table->timestamps();

            $table->spatialIndex('coordinate');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zip_codes');
    }
}