<?php

namespace App\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Uuid implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $model->resolveUuid()->fromBytes($value)->toString();
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return [
            $key => $model->resolveUuid()->fromString(strtolower($value))->getBytes(),
        ];
    }
}
