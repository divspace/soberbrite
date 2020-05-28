<?php

use App\Database\Models\ZipCode;
use Illuminate\Database\Seeder;

class ZipCodeSeeder extends Seeder
{
    public function run(): void
    {
        (new FileToCollection)->getZipCodes()->each(function ($zipCode) {
            factory(ZipCode::class)->create([
                'code' => $zipCode,
            ]);
        });
    }
}
