<?php

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = collect([
            [
                'program_type_id' => 2,
                'name' => 'Adult Children of Alcoholics',
                'abbreviation' => 'ACA/ACOA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Alcoholics Anonymous ',
                'abbreviation' => 'AA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Association of Recovering Motorcyclists',
                'abbreviation' => 'ARM',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Buddhist Recovery Network',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Bridge Club',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Celebrate Recovery',
                'abbreviation' => 'CR',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Cocaine Anonymous',
                'abbreviation' => 'CA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Courage International',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Crystal Meth Anonymous',
                'abbreviation' => 'CMA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Heroin Anonymous',
                'abbreviation' => 'HA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'LifeRing Secular Recovery',
                'abbreviation' => 'LSR',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Marijuana Anonymous',
                'abbreviation' => 'MA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Moderation Management',
                'abbreviation' => 'MM',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Narconon',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Narcotics Anonymous',
                'abbreviation' => 'NA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Nicotine Anonymous',
                'abbreviation' => 'NicA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Pagans In Recovery',
                'abbreviation' => 'PIR',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Pills Anonymous',
                'abbreviation' => 'PA',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Rational Recovery',
                'abbreviation' => 'RR',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Recovering Women Riders',
                'abbreviation' => 'RWR',
            ],
            [
                'program_type_id' => 1,
                'name' => 'Recovery Dharma',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Refuge Recovery',
                'abbreviation' => 'RR',
            ],
            [
                'program_type_id' => 1,
                'name' => 'SMART Recovery',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Secular Organizations for Sobriety',
                'abbreviation' => 'SOS',
            ],
            [
                'program_type_id' => 1,
                'name' => 'The Phoenix',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 1,
                'name' => 'Women for Sobriety',
                'abbreviation' => 'WFS',
            ],

            // ---------------------------------------------------------

            [
                'program_type_id' => 2,
                'name' => 'Al-Anon/Alateen',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 2,
                'name' => 'Co-Anon',
                'abbreviation' => null,
            ],
            [
                'program_type_id' => 2,
                'name' => 'Families Anonymous',
                'abbreviation' => 'FA',
            ],
            [
                'program_type_id' => 2,
                'name' => 'Nar-Anon',
                'abbreviation' => null,
            ],
        ]);

        $programs->each(function ($program) {
            factory(Program::class)->create($program);
        });
    }
}
