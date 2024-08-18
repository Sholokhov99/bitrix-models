<?php

namespace Sholokhov\BitrixModels\Builder;

/**
 * Генерирует сборщика запросов на основе описания модели
 *
 * @internal Используется в менеджерах моделей
 */
class QueryBuilder
{
    public function __construct(
        protected string $entity,
        protected object $settings
    )
    {
    }

    /**
     * Создание провайдера данных
     *
     * @return object
     */
    public function make(): object
    {
        return new class{};
    }

    /**
     * Провайдер поддерживаемый моделью
     *
     * @return string
     */
    private function getProvider(): string
    {
        return '';
    }
}