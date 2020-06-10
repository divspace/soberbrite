<?php

use App\Database\Models\Address;
use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\Profile;
use App\Database\Models\State;
use App\Database\Models\User;
use App\Database\Models\ZipCode;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    private string $email = 'kyle@soberbrite.com';

    private string $city = 'Scottsdale';

    private string $state = 'AZ';

    private string $zipCode = '85251';

    private string $street = '3015 N Scottsdale Rd';

    private string $username = 'soberbrite';

    private string $firstName = 'Kyle';

    private string $lastName = 'Anderson';

    private string $gender = 'M';

    private string $birthDate = '1983-12-21';

    private string $sobrietyDate = '2020-03-15';

    public function run(): void
    {
        $user = factory(User::class)->create([
            'email' => $this->email,
        ]);

        factory(Profile::class)->create([
            'user_id' => $user,
            'username' => $this->username,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'gender' => $this->gender,
            'birth_date' => $this->birthDate,
            'sobriety_date' => $this->sobrietyDate,
        ]);

        $location = Location::where([
            Location::CITY => City::where('name', $this->city)->pluck('id')->first(),
            Location::STATE => State::where('code', $this->state)->pluck('id')->first(),
            Location::ZIP_CODE => ZipCode::where('code', $this->zipCode)->pluck('id')->first(),
        ])->first();

        if (isset($location)) {
            factory(Address::class)->create([
                'user_id' => $user->id,
                'location_id' => $location->id,
                'street' => $this->street,
            ]);
        }

        factory(User::class, 10)->create()->each(static function (User $user): void {
            $user->address()->save(factory(Address::class)->make());
            $user->profile()->save(factory(Profile::class)->make());
        });
    }
}
