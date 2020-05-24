<?php

use App\Database\Models\ZipCode;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class ZipCodeSeeder extends Seeder
{
    public function run(): void
    {
        /** @see https://public.opendatasoft.com/explore/dataset/us-zip-code-latitude-and-longitude/export/ */
        $csv = fopen(storage_path('csv/zip-codes.csv'), 'r');

        while (($row = fgetcsv($csv, 100, ';')) !== false) {
            if (!is_numeric($row[0])) {
                continue;
            }

            factory(ZipCode::class)->create([
                'zip' => $row[0],
                'city' => $row[1],
                'state' => $row[2],
                'coordinate' => new Point($row[3], $row[4]),
                'timezone_offset' => $row[5].':00:00',
                'has_dst' => $row[6],
            ]);
        }

        fclose($csv);
    }
}
