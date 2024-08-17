<?php

namespace Sholokhov\BitrixModels\Models;

/**
 * Базовое описание структуры модели.
 *
 * Указанный интерфейс может использовапться вне пакета и будет поддерживаться обратная совместимость на сколько это возможно.
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @param string|null $siteID - ID сайта, для которого необходимо подгрузить настройки модели
     */
    public function __construct(?string $siteID = null)
    {
    }

    /**
     * Конструктор запросов
     *
     * @final
     * @return object
     */
    final public function query(): object
    {
        return $this->getManager()->getProvider('Query');
    }

    /**
     * Идентификатор модели
     *
     * @final
     * @return string
     */
    final public function getID(): string
    {
        return $this->getSettings()->getID();
    }

    /**
     * ID сайта, для которого инициализировалась модель
     *
     * @final
     * @return string
     */
    final public function getSiteID(): string
    {
        return $this->getSettings()->getSiteID();
    }

    /**
     * Настройки модели
     *
     * @final
     * @return object
     */
    final protected function getSettings(): object
    {
        return $this->getManager()->getProvider('Settings');
    }

    /**
     * Менеджер модели
     *
     * @final
     * @return object
     */
    final protected function getManager(): object
    {
        return new class{};
    }
}