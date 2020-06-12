<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

final class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use Notifiable;

    public const TABLE = 'users';

    public const EMAIL = 'email';

    public const PASSWORD = 'password';

    public const REMEMBER_TOKEN = 'remember_token';

    public const EMAIL_VERIFIED_AT = 'email_verified_at';

    protected $fillable = [
        self::EMAIL,
        self::PASSWORD,
    ];

    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::EMAIL => self::STRING,
        self::PASSWORD => self::STRING,
        self::REMEMBER_TOKEN => self::STRING,
        self::EMAIL_VERIFIED_AT => self::DATETIME,
    ];

    protected $dates = [
        self::EMAIL_VERIFIED_AT,
    ];

    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function resolveRouteBinding($value, $field = null): ?object
    {
        if (is_numeric($value)) {
            $user = $this->where(self::ID, $value)->first();
        } elseif (Str::isUuid($value)) {
            $user = $this->whereUuid($value)->first();
        } else {
            $user = $this->whereHas('profile', static function (Builder $query) use ($value): void {
                $query->where(Profile::USERNAME, $value);
            })->first();
        }

        return $user ?? null;
    }
}
