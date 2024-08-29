<?php

namespace Sholokhov\BitrixModels\Models;

use ReflectionException;

use Sholokhov\BitrixModels\DTO\ModelSettingsInterface;
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
     * @throws ConfigurationNotFoundException
     * @throws InvalidValueException
     * @throws ReflectionException
     */
    public function __construct(?string $siteID = null)
    {
        $this->manager = new Manager(static::class, $siteID);
    }

    /**
     * Конструктор запросов
     *
     * @final
     * @return object
     * @throws SystemException
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
     * @throws SystemException
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
        return $this->manager->getSiteID();
    }

    /**
     * Настройки модели
     *
     * @final
     * @return ModelSettingsInterface
     * @throws SystemException
     */
    final protected function getSettings(): ModelSettingsInterface
    {
        return $this->manager->getSettings();
    }
}