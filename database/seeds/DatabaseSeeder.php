<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'cities',
        'states',
        'zip_codes',
        'area_codes',
        'countries',
        'locations',
        'programs',
        'users',
    ];

    public function run(): void
    {
        collect($this->tables)->each(function ($table) {
            if (!DB::table($table)->count()) {
                $this->call(Str::of($table)->studly()->singular().'Seeder'::class);
            }
        });
    }
}
