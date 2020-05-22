<?php

namespace App\Database\Models;

use App\Database\Models\User;
use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'sobriety_date',
    ];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'user_id' => 'integer',
        'sobriety_date' => 'date:Y-m-d',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
