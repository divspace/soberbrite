<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Address extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'addresses';

    /**
     * @var string
     */
    public const USER = 'user_id';

    /**
     * @var string
     */
    public const LOCATION = 'location_id';

    /**
     * @var string
     */
    public const STREET = 'street';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::STREET,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::USER => self::INTEGER,
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
