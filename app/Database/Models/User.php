<?php

declare(strict_types = 1);

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

final class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use HasFactory;
    use MustVerifyEmail;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
    public const TWO_FACTOR_SECRET = 'two_factor_secret';

    /**
     * @var string
     */
    public const TWO_FACTOR_RECOVERY_CODES = 'two_factor_recovery_codes';

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
        self::TWO_FACTOR_SECRET,
        self::TWO_FACTOR_RECOVERY_CODES,
        self::REMEMBER_TOKEN,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::EMAIL => self::STRING,
        self::PASSWORD => self::STRING,
        self::TWO_FACTOR_SECRET => self::STRING,
        self::TWO_FACTOR_RECOVERY_CODES => self::STRING,
        self::REMEMBER_TOKEN => self::STRING,
        self::EMAIL_VERIFIED_AT => self::DATETIME,
    ];

    /**
     * @var string[]
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

        return self::whereHas('profile', static function (Builder $query) use ($value): void {
            $query->where(Profile::USERNAME, $value);
        })->first();
    }
}
