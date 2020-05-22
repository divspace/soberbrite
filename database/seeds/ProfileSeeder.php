<?php

use App\Database\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        factory(Profile::class)->create([
            'username' => 'soberbrite',
            'first_name' => 'Kyle',
            'last_name' => 'Anderson',
            'sobriety_date' => '2020-03-15',
        ]);
    }
}
