<?php

namespace Sholokhov\BitrixModels\DTO;

use Sholokhov\BitrixOption\StorageInterface;

/**
 * Структура настроек модели.
 */
interface ModelSettingsInterface extends StorageInterface
{
    /**
     * Идентификатор модели.
     *
     * @return string
     */
    public function getID(): string;

    /**
     * Уникальный символьный код модели
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Объект модели
     *
     * @return string
     */
    public function getEntity(): string;
}