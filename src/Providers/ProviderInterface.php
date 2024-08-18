<?php

namespace Sholokhov\BitrixModels\Providers;

interface ProviderInterface
{
    /**
     * Проверка возможности работы провайдера
     *
     * @param string $entity
     * @return bool
     */
    public static function supported(string $entity): bool;
}