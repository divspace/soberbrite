<?php

use App\Database\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(storage_path('csv/states.csv'), 'r');

        fgetcsv($file, 25, ';');

        while (($row = fgetcsv($file, 25, ';')) !== false) {
            factory(State::class)->create([
                'code' => $row[0],
                'name' => $row[1],
            ]);
        }

        fclose($file);
    }
}
