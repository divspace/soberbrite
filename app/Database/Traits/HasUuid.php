<?php

namespace App\Database\Traits;

use App\Database\Casts\Uuid;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid as BaseUuid;

trait HasUuid
{
    protected $uuidVersions = [
        'uuid1',
        'uuid3',
        'uuid4',
        'uuid5',
        'uuid6',
    ];

    abstract public function hasCast(string $key, $types = null);

    public static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            foreach ($model->uuidColumns() as $item) {
                $uuid = $model->resolveUuid();

                if (isset($model->attributes[$item]) && ! is_null($model->attributes[$item])) {
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

    public function uuidColumn(): string
    {
        return 'uuid';
    }

    public function uuidColumns(): array
    {
        return [$this->uuidColumn()];
    }

    public function resolveUuid(): BaseUuid
    {
        return call_user_func([BaseUuid::class, $this->resolveUuidVersion()]);
    }

    public function resolveUuidVersion(): string
    {
        if (property_exists($this, 'uuidVersion') && in_array($this->uuidVersion, $this->uuidVersions)) {
            return $this->uuidVersion;
        }

        return 'uuid4';
    }

    public function scopeWhereUuid(Builder $query, string $uuid, ?string $uuidColumn = null): Builder
    {
        $uuidColumn = !is_null($uuidColumn) && in_array($uuidColumn, $this->uuidColumns())
            ? $uuidColumn
            : $this->uuidColumns()[0];

        $uuid = array_map(function ($uuid) {
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
            array_walk($uuid, function (&$uuid) {
                $uuid = $this->resolveUuid()->fromString($uuid)->getBytes();
            });

            return $uuid;
        }

        return Arr::wrap($this->resolveUuid()->fromString($uuid)->getBytes());
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->whereUuid($value)->firstOrFail();
    }
}
