<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class City extends Model
{
    public const TABLE = 'cities';

    public const NAME = 'name';

    protected $fillable = [
        self::NAME,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::NAME => self::STRING,
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
