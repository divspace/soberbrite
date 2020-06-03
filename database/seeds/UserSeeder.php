<?php

use App\Database\Models\Address;
use App\Database\Models\Location;
use App\Database\Models\Profile;
use App\Database\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $email = 'kyle@soberbrite.com';

    private $city = 'Scottsdale';

    private $state = 'AZ';

    private $zipCode = '85251';

    private $street = '3015 N Scottsdale Rd';

    private $username = 'soberbrite';

    private $firstName = 'Kyle';

    private $lastName = 'Anderson';

    private $gender = 'M';

    private $birthDate = '1983-12-21';

    private $sobrietyDate = '2020-03-15';

    public function run(): void
    {
        $user = factory(User::class)->create([
            'email' => $this->email,
        ]);

        factory(Profile::class)->create([
            'user_id' => $user->id,
            'username' => $this->username,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'gender' => $this->gender,
            'birth_date' => $this->birthDate,
            'sobriety_date' => $this->sobrietyDate,
        ]);

        factory(User::class, 50)->create()->each(function ($user): void {
            $user->address()->save(factory(Address::class)->make());
            $user->profile()->save(factory(Profile::class)->make());
        });

        $location = Location::whereHas('city', function (Builder $query): void {
            $query->where('name', $this->city);
        })->whereHas('state', function (Builder $query): void {
            $query->where('code', $this->state);
        })->whereHas('zipCode', function (Builder $query): void {
            $query->where('code', $this->zipCode);
        })->first();

        if (isset($location)) {
            factory(Address::class)->create([
                'user_id' => $user->id,
                'location_id' => $location->id,
                'street' => $this->street,
            ]);
        }
    }
}
