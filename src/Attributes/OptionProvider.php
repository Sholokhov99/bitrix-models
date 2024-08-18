<?php

namespace Sholokhov\BitrixModels\Attributes;

use Attribute;

/**
 * Описывает используемый провайдер настроек
 */
#[Attribute(Attribute::TARGET_CLASS)]
class OptionProvider
{
    public function __construct(
        public readonly string $entity
    )
    {

    }
}