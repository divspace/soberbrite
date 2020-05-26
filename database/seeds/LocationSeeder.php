<?php

use App\Database\Models\Location;
use App\Database\Models\State;
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
            $state = State::whereCode($row[2])->first();
            $zipCode = $row[0];
            $latitude = $row[3];
            $longitude = $row[4];
            $timezoneOffset = $row[5];
            $observesDst = $row[6];

            if ($state) {
                factory(Location::class)->create([
                    'state_id' => $state->id,
                    'zip_code' => $zipCode,
                    'city' => $city,
                    'coordinate' => new Point($latitude, $longitude),
                    'timezone_offset' => $timezoneOffset.':00:00',
                    'observes_dst' => $observesDst,
                ]);
            }
        }

        fclose($file);
    }
}
