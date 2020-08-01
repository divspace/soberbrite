<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('zip_codes', static function (Blueprint $table): void {
            $table->smallIncrements('id');
            $table->char('code', 5)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zip_codes');
    }
}
