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
    private const CITY = 'city';

    private const STATE = 'state';

    private const ZIP_CODE = 'zip_code';

    public function run(): void
    {
        $user = factory(User::class)->create([
            User::EMAIL => $this->get(User::EMAIL),
        ]);

        factory(Profile::class)->create([
            Profile::USER => $user->id,
            Profile::USERNAME => $this->get(Profile::USERNAME),
            Profile::FIRST_NAME => $this->get(Profile::FIRST_NAME),
            Profile::LAST_NAME => $this->get(Profile::LAST_NAME),
            Profile::SEX => $this->get(Profile::SEX),
            Profile::BIRTH_DATE => $this->get(Profile::BIRTH_DATE),
            Profile::SOBRIETY_DATE => $this->get(Profile::SOBRIETY_DATE),
        ]);

        $location = Location::where([
            Location::CITY => City::where(City::NAME, $this->get(self::CITY))
                ->pluck(City::ID)
                ->first(),
            Location::STATE => State::where(State::CODE, $this->get(self::STATE))
                ->pluck(State::ID)
                ->first(),
            Location::ZIP_CODE => ZipCode::where(ZipCode::CODE, $this->get(self::ZIP_CODE))
                ->pluck(ZipCode::ID)
                ->first(),
        ])->first();

        if (isset($location)) {
            factory(Address::class)->create([
                Address::USER => $user->id,
                Address::LOCATION => $location->id,
                Address::STREET => $this->get(Address::STREET),
            ]);
        }

        factory(User::class, 10)->create()->each(static function (User $user): void {
            $user->address()->save(factory(Address::class)->make());
            $user->profile()->save(factory(Profile::class)->make());
        });
    }

    private function get(string $attribute): string
    {
        $info = [
            Address::STREET => '3015 N Scottsdale Rd',
            Profile::BIRTH_DATE => '1983-12-21',
            Profile::FIRST_NAME => 'Kyle',
            Profile::LAST_NAME => 'Anderson',
            Profile::SEX => 'M',
            Profile::SOBRIETY_DATE => '2020-03-15',
            Profile::USERNAME => 'soberbrite',
            User::EMAIL => 'kyle@soberbrite.com',
            self::CITY => 'Scottsdale',
            self::STATE => 'AZ',
            self::ZIP_CODE => '85251',
        ];

        return $info[$attribute] ?? '';
    }
}
