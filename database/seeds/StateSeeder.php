<?php

use App\Database\Models\State;
use Illuminate\Database\Seeder;

final class StateSeeder extends Seeder
{
    public function run(): void
    {
        (new Lookup('states'))->get()->each(function (array $state): void {
            factory(State::class)->create([
                'code' => $state['code'],
                'name' => $state['name'],
            ]);
        });
    }
}
