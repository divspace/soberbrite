<?php

namespace App\Database\Casts;

use App\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

final class Timezone implements CastsAttributes
{
    /**
     * @param Model $model
     */
    public function get($model, string $key, $value, array $attributes): string
    {
        return Str::of((string) $value)->beforeLast(':')->__toString();
    }

    /**
     * @param Model $model
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        return (string) $value;
    }
}
