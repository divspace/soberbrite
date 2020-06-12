<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProgramType::class);
    }
}
