<?php

namespace Sholokhov\BitrixModels\Models;

use ReflectionException;

use Sholokhov\BitrixModels\Exception\SystemException;

use Sholokhov\BitrixOption\Exception\InvalidValueException;
use Sholokhov\BitrixOption\Exception\ConfigurationNotFoundException;

/**
 * Базовое описание структуры модели.
 *
 * Указанная абстракция может использовапться вне пакета и будет поддерживаться обратная совместимость на сколько это возможно.
 */
abstract class AbstractModel implements ModelInterface
{
    private readonly Manager $manager;

    /**
     * @param string|null $siteID - ID сайта, для которого необходимо подгрузить настройки модели
     * @throws ReflectionException
     * @throws SystemException
     * @throws ConfigurationNotFoundException
     * @throws InvalidValueException
     */
    public function __construct(?string $siteID = null)
    {
        $this->manager = new Manager($this::class, $siteID);
    }

    /**
     * Конструктор запросов
     *
     * @final
     * @return object
     */
    final public function query(): object
    {
        return $this->manager->getQueryProvider();
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
        return $this->manager->getSettingsProvider();
    }
}