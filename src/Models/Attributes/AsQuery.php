<?php

declare(strict_types=1);

namespace Sholokhov\BitrixModels\Models\Attributes;

use Attribute;

/**
 * Описывает используемый сборщик запросов в рамках модели
 */
#[Attribute(Attribute::TARGET_CLASS)]
class AsQuery
{
    public function __construct(
        public readonly string $builder
    )
    {
    }
}