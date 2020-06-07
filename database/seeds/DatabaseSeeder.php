<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class DatabaseSeeder extends Seeder
{
    private array $tables = [
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
        (new Collection($this->tables))->each(function (string $table): void {
            if (DB::table($table)->count() === 0) {
                $this->call(Str::of($table)->studly()->singular().'Seeder'::class);
            }
        });
    }
}
