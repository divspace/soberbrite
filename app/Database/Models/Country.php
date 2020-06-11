<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class Country extends Model
{
    public const TABLE = 'countries';

    public const CODE = 'code';

    public const NAME = 'name';

    protected $fillable = [
        self::CODE,
        self::NAME,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::CODE => self::STRING,
        self::NAME => self::STRING,
    ];
}
