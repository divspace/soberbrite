<?php

use App\Database\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        (new LookupCollection())->getStates()->each(function ($state): void {
            factory(State::class)->create([
                'code' => $state['code'],
                'name' => $state['name'],
            ]);
        });
    }
}
