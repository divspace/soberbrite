<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    private const CITY = 'city_id';

    private const STATE = 'state_id';

    private const ZIP_CODE = 'zip_code_id';

    public function up(): void
    {
        Schema::create('locations', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->integer(self::CITY)->unsigned();
            $table->tinyInteger(self::STATE)->unsigned();
            $table->smallInteger(self::ZIP_CODE)->unsigned();
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
            $table->time('timezone_offset');
            $table->boolean('observes_dst')->default(1);
            $table->timestamps();

            $table->foreign(self::CITY)->references('id')->on('cities');
            $table->foreign(self::STATE)->references('id')->on('states');
            $table->foreign(self::ZIP_CODE)->references('id')->on('zip_codes');

            $table->unique([self::CITY, self::STATE, self::ZIP_CODE]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
}
