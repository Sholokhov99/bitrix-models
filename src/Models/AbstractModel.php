<?php

namespace Sholokhov\BitrixModels\Models;

use Bitrix\Main\Result;
use ReflectionException;

use Sholokhov\BitrixModels\Providers\Query\Builder as QueryBuilder;
use Sholokhov\BitrixModels\DTO\ModelSettingsInterface;
use Sholokhov\BitrixModels\Exception\SystemException;

use Sholokhov\BitrixOption\Exception\InvalidValueException;
use Sholokhov\BitrixOption\Builder\Loader as SettingsLoader;
use Sholokhov\BitrixOption\Exception\ConfigurationNotFoundException;
use Sholokhov\BitrixOption\Manager as SettingsManager;

/**
 * Базовое описание структуры модели.
 *
 * Указанная абстракция может использовапться вне пакета и будет поддерживаться обратная совместимость на сколько это возможно.
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * Провайдер настроек модели
     *
     * @var SettingsManager
     */
    private readonly SettingsManager $settingsProvider;

    /**
     * @param string|null $siteID - ID сайта, для которого необходимо подгрузить настройки модели
     * @throws ConfigurationNotFoundException
     * @throws InvalidValueException
     * @throws ReflectionException
     */
    public function __construct(?string $siteID = null)
    {
        $this->settingsProvider = SettingsLoader::loadByEntity($this, $siteID);
    }

    public function registration(ModelSettingsInterface $settings): Result
    {
        // Нормализовать

        return $this->settingsProvider->set($settings);
    }

    public function unRegistration(): void
    {
        $this->settingsProvider->remove();
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
        return QueryBuilder::make(static::class, $this->getSettings());
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
        return $this->settingsProvider->getSiteID();
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
        $settings = $this->settingsProvider->get();

        if (!($settings instanceof ModelSettingsInterface)) {
            throw new SystemException('Model settings store does not implement interface ' . ModelSettingsInterface::class);
        }

        return $settings;
    }
}