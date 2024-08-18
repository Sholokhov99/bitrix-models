<?php

namespace Sholokhov\BitrixModels\Providers\Query;

/**
 * Генерирует сборщика запросов на основе описания модели
 *
 * @internal Используется в менеджерах моделей
 */
class Builder
{
    public static function make(string $entity, object $settings): object
    {
        return new class {};
    }
}