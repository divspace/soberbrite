<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

final class User extends Model
{
    use HasUuid, Notifiable;

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
        self::ID => self::STRING,
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

    public function resolveRouteBinding($value, $field = null)
    {
        if (Str::isUuid($value)) {
            return $this->where(self::ID, $value)->firstOrFail();
        }

        return $this->whereHas('profile', static function (Builder $query) use ($value): void {
            $query->where(Profile::USERNAME, $value);
        })->firstOrFail();
    }
}
