<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class DatabaseSeeder extends Seeder
{
    /**
     * The list of additional tables to seed that aren't in the lookup config.
     *
     * @var string[]
     */
    private static array $additionalTables = [
        'recovery_programs',
        'family_groups',
        'users',
    ];

    public function run(): void
    {
        (new Collection(config('lookup.tables')))
            ->sort(static function (array $a, array $b): int {
                return $a['fill_order'] <=> $b['fill_order'];
            })
            ->keys()
            ->reject(static function (string $table): bool {
                return in_array($table, self::$additionalTables, true);
            })
            ->merge(self::$additionalTables)
            ->transform(static function (string $table): array {
                return [
                    'name' => $table,
                    'seeder' => Str::of($table)->studly()->singular().'Seeder',
                ];
            })
            ->each(function (array $table): void {
                if (DB::table($table['name'])->count() === 0) {
                    $this->call($table['seeder']);
                }
            });
    }
}
