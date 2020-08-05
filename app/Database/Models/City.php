<?php

declare(strict_types = 1);

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class City extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'cities';

    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::NAME => self::STRING,
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * @param string $value
     * @param string|null $field
     */
    public function resolveRouteBinding($value, $field = null): ?object
    {
        $field ??= self::NAME;

        if (is_numeric($value)) {
            $field = self::ID;
        }

        return $this->where($field, $value)->first();
    }
}
