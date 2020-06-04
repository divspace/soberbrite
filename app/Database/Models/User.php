<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

final class User extends Authenticatable implements MustVerifyEmail
{
    use HasTimestamps, HasUuid, Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'email_verified_at',
    ];

    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function resolveRouteBinding($value, $field = null): User
    {
        if (Str::isUuid($value)) {
            return $this->where('id', $value)->firstOrFail();
        }

        return $this->whereHas('profile', function (Builder $query) use ($value): void {
            $query->where('username', $value);
        })->firstOrFail();
    }
}
