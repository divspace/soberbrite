<?php

use App\Database\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        (new FileToCollection)->getStates()->each(function ($state) {
            factory(State::class)->create([
                'code' => $state['code'],
                'name' => $state['name'],
            ]);
        });
    }
}
