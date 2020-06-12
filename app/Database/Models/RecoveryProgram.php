<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class RecoveryProgram extends Model
{
    public const TABLE = 'recovery_programs';

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
