<?php

declare(strict_types = 1);

namespace App\Database\Casts;

use App\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

final class Timezone implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $value
     */
    public function get($model, string $key, $value, array $attributes): string
    {
        return Str::of((string) $value)->beforeLast(':')->__toString();
    }

    /**
     * @param Model $model
     * @param string $value
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        return (string) $value;
    }
}
