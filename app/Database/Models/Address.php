<?php

namespace App\Database\Models;

use App\Database\Models\User;
use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'user_id'
        'street',
        'city',
        'state',
        'zip_code',
        'country',
    ];

    protected $casts = [
        'id' => Uuid::class,
        'user_id' => Uuid::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
