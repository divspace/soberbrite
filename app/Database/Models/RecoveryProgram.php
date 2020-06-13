<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class RecoveryProgram extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'recovery_programs';

    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string
     */
    public const ABBREVIATION = 'abbreviation';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
        self::ABBREVIATION,
    ];

    /**
     * @var array
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::NAME => self::STRING,
        self::ABBREVIATION => self::STRING,
    ];
}
