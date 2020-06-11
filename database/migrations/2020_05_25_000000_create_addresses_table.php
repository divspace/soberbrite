<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    private const USER = 'user_id';

    private const LOCATION = 'location_id';

    public function up(): void
    {
        Schema::create('addresses', static function (Blueprint $table): void {
            $table->uuid('id');
            $table->uuid(self::USER);
            $table->bigInteger(self::LOCATION)->unsigned();
            $table->string('street');
            $table->timestamps();

            $table->foreign(self::USER)->references('id')->on('users');
            $table->foreign(self::LOCATION)->references('id')->on('locations');

            $table->primary(['id', self::USER, self::LOCATION]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
}
