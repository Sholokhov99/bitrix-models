<?php

namespace Sholokhov\BitrixModels\Builder;

use ReflectionClass;
use ReflectionException;

/**
 * @internal Используется при стандартной сборке объектов
 */
class EntityBuilder
{
    /**
     * @throws ReflectionException
     */
    public static function make(string $entity, ...$arguments): object
    {
        return (new ReflectionClass($entity))->newInstance(...$arguments);
    }
}