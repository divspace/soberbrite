<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaCodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('area_codes', static function (Blueprint $table): void {
            $table->smallIncrements('id');
            $table->tinyInteger('state_id')->unsigned();
            $table->char('code', 3)->unique();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_codes');
    }
}
