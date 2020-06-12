<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class FamilyGroup extends Model
{
    public const TABLE = 'family_groups';

    public const NAME = 'name';

    public const ABBREVIATION = 'abbreviation';

    protected $fillable = [
        self::NAME,
        self::ABBREVIATION,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::NAME => self::STRING,
        self::ABBREVIATION => self::STRING,
    ];
}
