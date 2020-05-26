<?php

use App\Database\Models\Location;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        /** @see https://public.opendatasoft.com */
        $file = fopen(storage_path('csv/zip-codes.csv'), 'r');

        fgetcsv($file, 100, ';');

        while (($row = fgetcsv($file, 100, ';')) !== false) {
            $city = $row[1];
            $state = $row[2];
            $zipCode = $row[0];
            $latitude = $row[3];
            $longitude = $row[4];
            $timezoneOffset = $row[5];
            $observesDst = $row[6];

            factory(Location::class)->create([
                'zip_code' => $zipCode,
                'city' => $city,
                'state' => $state,
                'coordinate' => new Point($latitude, $longitude),
                'timezone_offset' => $timezoneOffset.':00:00',
                'observes_dst' => $observesDst,
            ]);
        }

        fclose($file);
    }
}
