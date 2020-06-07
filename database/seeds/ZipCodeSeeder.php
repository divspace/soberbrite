<?php

use App\Database\Models\ZipCode;
use Illuminate\Database\Seeder;

final class ZipCodeSeeder extends Seeder
{
    public function run(): void
    {
        (new Lookup('zipCodes'))->get()->each(function (string $zipCode): void {
            factory(ZipCode::class)->create([
                'code' => $zipCode,
            ]);
        });
    }
}
