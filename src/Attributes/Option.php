<?php

namespace Sholokhov\BitrixModels\Attributes;

use Attribute;

/**
 * Производит описание хранения значения параметра
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Option
{
    /**
     * @param string $module ID модуля которому принадлежит модель
     * @param string $name Наименование параметра настройки
     */
    public function __construct(
        public readonly string $module,
        public readonly string $name
    )
    {

    }
}