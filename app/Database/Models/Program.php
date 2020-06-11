<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class Program extends Model
{
    public const TABLE = 'programs';

    public const TYPE = 'program_type_id';

    public const NAME = 'name';

    public const ABBREVIATION = 'abbreviation';

    protected $fillable = [
        self::NAME,
        self::ABBREVIATION,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::TYPE => self::INTEGER,
        self::NAME => self::STRING,
        self::ABBREVIATION => self::STRING,
    ];
}
