<?php

declare(strict_types = 1);

namespace App\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use LogicException;

class Model extends BaseModel
{
    /**
     * @var string
     */
    public const ID = 'id';

    /**
     * @var string
     */
    public const CREATED_AT = 'created_at';

    /**
     * @var string
     */
    public const DELETED_AT = 'deleted_at';

    /**
     * @var string
     */
    public const UPDATED_AT = 'updated_at';

    /**
     * @var string
     */
    public const ARRAY = 'array';

    /**
     * @var string
     */
    public const BOOLEAN = 'boolean';

    /**
     * @var string
     */
    public const COLLECTION = 'collection';

    /**
     * @var string
     */
    public const DATE = 'date';

    /**
     * @var string
     */
    public const DATETIME = 'datetime';

    /**
     * @var string
     */
    public const DECIMAL = 'decimal';

    /**
     * @var string
     */
    public const DOUBLE = 'double';

    /**
     * @var string
     */
    public const FLOAT = 'float';

    /**
     * @var string
     */
    public const INTEGER = 'integer';

    /**
     * @var string
     */
    public const OBJECT = 'object';

    /**
     * @var string
     */
    public const REAL = 'real';

    /**
     * @var string
     */
    public const STRING = 'string';

    /**
     * @var string
     */
    public const TIMESTAMP = 'timestamp';

    /**
     * @param string $method
     * @throws LogicException
     */
    public function getRelationshipFromMethod($method): void
    {
        throw new LogicException("Lazy loading relationships is not allowed ({$method})");
    }
}
