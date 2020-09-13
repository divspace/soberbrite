<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Database\Models\FamilyGroup;
use App\Database\Models\RecoveryProgram;
use App\Database\Models\User;
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
        RecoveryProgram::TABLE,
        FamilyGroup::TABLE,
        User::TABLE,
    ];

    public function run(): void
    {
        (new Collection(config('lookup.tables')))
            ->sort(static fn (array $a, array $b): int => $a['fill_order'] <=> $b['fill_order'])
            ->keys()
            ->reject(static fn (string $table): bool => in_array($table, self::$additionalTables, true))
            ->merge(self::$additionalTables)
            ->transform(static fn (string $table): array => [
                'name' => $table,
                'seeder' => 'Database\\Seeders\\'.Str::of($table)->studly()->singular().'Seeder',
            ])
            ->each(function (array $table): void {
                if (DB::table($table['name'])->count() === 0) {
                    $this->call($table['seeder']);
                }
            });
    }
}
