<?php

declare(strict_types = 1);

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class Country extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'countries';

    /**
     * @var string
     */
    public const CODE = 'code';

    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::CODE,
        self::NAME,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::CODE => self::STRING,
        self::NAME => self::STRING,
    ];

    /**
     * @param string $value
     * @param string|null $field
     */
    public function resolveRouteBinding($value, $field = null): ?object
    {
        $field ??= self::NAME;

        if (is_numeric($value)) {
            $field = self::ID;
        } elseif (\mb_strlen($value) === 2) {
            $field = self::CODE;
        }

        return $this->where($field, $value)->first();
    }
}
