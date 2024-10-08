<?php

namespace Sholokhov\BitrixModels\Attributes;

use Attribute;

/**
 * Описывает используемый сборщик запросов в рамках модели
 */
#[Attribute(Attribute::TARGET_CLASS)]
class QueryProvider
{
    public function __construct(
        public readonly string $entity
    )
    {
    }
}