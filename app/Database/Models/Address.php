<?php

namespace App\Database\Models;

use App\Database\Casts\Address as AddressCast;
use App\Database\Models\User;
use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use AddressCast, HasTimestamps, HasUuid;

    protected $fillable = [
        'line_1',
        'line_2',
        'city',
        'state',
        'zip_code',
        'country',
    ];

    protected $casts = [
        'uuid' => Uuid::class,
        'user_id' => 'integer',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
