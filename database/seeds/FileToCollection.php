<?php

use Illuminate\Support\Collection;

class FileToCollection
{
    public function getLocations(): Collection
    {
        $data = collect();

        $file = fopen(storage_path('csv/zip-codes.csv'), 'r');

        fgetcsv($file, 100, ';');

        while (($row = fgetcsv($file, 100, ';')) !== false) {
            $data->push([
                'cityName' => $row[1],
                'stateCode' => $row[2],
                'zipCode' => $row[0],
                'latitude' => (float) $row[3],
                'longitude' => (float) $row[4],
                'timezoneOffset' => (int) $row[5],
                'observesDst' => (bool) $row[6],
            ]);
        }

        fclose($file);

        return $data;
    }

    public function getStates(): Collection
    {
        $data = collect();

        $file = fopen(storage_path('csv/states.csv'), 'r');

        fgetcsv($file, 25, ';');

        while (($row = fgetcsv($file, 25, ';')) !== false) {
            $data->push([
                'code' => $row[0],
                'name' => $row[1],
            ]);
        }

        fclose($file);

        return $data;
    }
}
