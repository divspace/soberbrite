<?php

namespace App\Database\Models;

use App\Traits\HasTimestamps;
use App\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasTimestamps, HasUuid, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'sobriety_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'sobriety_date' => 'date',
        'email_verified_at' => 'datetime',
    ];
}
