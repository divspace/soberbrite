<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Address extends Model
{
    use HasUuid;

    public const TABLE = 'addresses';

    public const USER = 'user_id';

    public const LOCATION = 'location_id';

    public const STREET = 'street';

    protected $fillable = [
        self::STREET,
    ];

    protected $casts = [
        self::ID => self::STRING,
        self::USER => self::STRING,
        self::LOCATION => self::INTEGER,
        self::STREET => self::STRING,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
