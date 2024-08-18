<?php

namespace Sholokhov\BitrixModels\Helpers;

use ReflectionClass;
use ReflectionException;

class Attribute
{
    /**
     * Получение доступных атрибутов по названию
     *
     * @param string|object $entity
     * @param string $name
     * @return object[]
     * @throws ReflectionException
     */
    public static function get(string|object $entity, string $name): array
    {
        $result = [];
        $reflection = new ReflectionClass($entity);
        $attributes = $reflection->getAttributes($name);

        foreach ($attributes as $attribute) {
            $result[] = $attribute->newInstance();
        }

        return $result;
    }
}