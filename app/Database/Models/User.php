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

final class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use Notifiable;

    /**
     * @var string
     */
    public const TABLE = 'users';

    /**
     * @var string
     */
    public const EMAIL = 'email';

    /**
     * @var string
     */
    public const PASSWORD = 'password';

    /**
     * @var string
     */
    public const REMEMBER_TOKEN = 'remember_token';

    /**
     * @var string
     */
    public const EMAIL_VERIFIED_AT = 'email_verified_at';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::EMAIL,
        self::PASSWORD,
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    /**
     * @var array
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::EMAIL => self::STRING,
        self::PASSWORD => self::STRING,
        self::REMEMBER_TOKEN => self::STRING,
        self::EMAIL_VERIFIED_AT => self::DATETIME,
    ];

    /**
     * @var array
     */
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

    /**
     * @param string $value
     * @param string|null $field
     */
    public function resolveRouteBinding($value, $field = null): ?object
    {
        if (is_numeric($value)) {
            return $this->where(self::ID, $value)->first();
        }

        return static::whereHas('profile', static function (Builder $query) use ($value): void {
            $query->where(Profile::USERNAME, $value);
        })->first();
    }
}
