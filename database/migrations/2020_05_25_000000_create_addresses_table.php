<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table): void {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->bigInteger('location_id')->unsigned();
            $table->string('street');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');

            $table->primary(['id', 'user_id', 'location_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
}
