<?php

namespace App\Database\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    abstract public function hasCast(string $key, $types = null): bool;

    public static function bootHasUuid(): void
    {
        static::creating(static function ($model): void {
            foreach ($model->uuidColumns() as $item) {
                $uuid = $model->resolveUuid();

                if (isset($model->attributes[$item]) && $model->attributes[$item] !== null) {
                    try {
                        $uuid = $uuid->fromString(strtolower($model->attributes[$item]));
                    } catch (InvalidUuidStringException $exception) {
                        Log::debug($exception);

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
        return \call_user_func([Uuid::class, 'uuid4']);
    }

    public function scopeWhereUuid(Builder $query, string $uuid, ?string $uuidColumn = null): Builder
    {
        $uuidColumn = $uuidColumn !== null && \in_array($uuidColumn, $this->uuidColumns(), true)
            ? $uuidColumn
            : $this->uuidColumns()[0];

        $uuid = array_map(fn ($uuid): string => Str::lower($uuid), Arr::wrap($uuid));

        if ($this->isClassCastable($uuidColumn)) {
            $uuid = $this->bytesFromUuid($uuid);
        }

        return $query->whereIn($uuidColumn, Arr::wrap($uuid));
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (Str::isUuid($value)) {
            return $this->where('id', $value)->firstOrFail();
        }

        return null;
    }

    protected function bytesFromUuid($uuid): array
    {
        if (\is_array($uuid) || $uuid instanceof Arrayable) {
            array_walk($uuid, function (&$uuid): void {
                $uuid = $this->resolveUuid()->fromString($uuid)->getBytes();
            });

            return $uuid;
        }

        return Arr::wrap($this->resolveUuid()->fromString($uuid)->getBytes());
    }
}
