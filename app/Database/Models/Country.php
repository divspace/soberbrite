<?php

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
}
