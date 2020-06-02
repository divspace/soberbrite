<?php

namespace App\Database\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    abstract public function hasCast(string $key, $types = null);

    public static function bootHasUuid(): void
    {
        static::creating(function ($model): void {
            foreach ($model->uuidColumns() as $item) {
                $uuid = $model->resolveUuid();

                if (isset($model->attributes[$item]) && !is_null($model->attributes[$item])) {
                    try {
                        $uuid = $uuid->fromString(strtolower($model->attributes[$item]));
                    } catch (InvalidUuidStringException $e) {
                        $uuid = $uuid->fromBytes($model->attributes[$item]);
                    }
                }

                $model->{$item} = strtolower($uuid->toString());
            }
        });
    }

    public function getKeyType(): string
    {
        return 'string';
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    public function uuidColumns(): array
    {
        return [$this->uuidColumn()];
    }

    public function resolveUuid(): Uuid
    {
        return call_user_func([Uuid::class, 'uuid4']);
    }

    public function scopeWhereUuid(Builder $query, string $uuid, ?string $uuidColumn = null): Builder
    {
        $uuidColumn = !is_null($uuidColumn) && in_array($uuidColumn, $this->uuidColumns())
            ? $uuidColumn
            : $this->uuidColumns()[0];

        $uuid = array_map(function ($uuid): string {
            return Str::lower($uuid);
        }, Arr::wrap($uuid));

        if ($this->isClassCastable($uuidColumn)) {
            $uuid = $this->bytesFromUuid($uuid);
        }

        return $query->whereIn($uuidColumn, Arr::wrap($uuid));
    }

    protected function bytesFromUuid($uuid): array
    {
        if (is_array($uuid) || $uuid instanceof Arrayable) {
            array_walk($uuid, function (&$uuid): void {
                $uuid = $this->resolveUuid()->fromString($uuid)->getBytes();
            });

            return $uuid;
        }

        return Arr::wrap($this->resolveUuid()->fromString($uuid)->getBytes());
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (Str::isUuid($value)) {
            return $this->where('id', $value)->firstOrFail();
        }
    }
}
