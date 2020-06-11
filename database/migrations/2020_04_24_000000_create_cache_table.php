<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCacheTable extends Migration
{
    public function up(): void
    {
        Schema::create('cache', static function (Blueprint $table): void {
            $table->string('key')->unique();
            $table->mediumText('value');
            $table->integer('expiration');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache');
    }
}
