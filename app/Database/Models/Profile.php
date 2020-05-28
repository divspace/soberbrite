<?php

namespace App\Database\Models;

use App\Database\Models\User;
use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'username',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'gender',
        'birth_date',
        'sobriety_date',
    ];

    protected $casts = [
        'id' => Uuid::class,
        'user_id' => Uuid::class,
        'username' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'gender' => 'string',
        'birth_date' => 'date:Y-m-d',
        'sobriety_date' => 'date:Y-m-d',
    ];

    protected $dates = [
        'birth_date',
        'sobriety_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
