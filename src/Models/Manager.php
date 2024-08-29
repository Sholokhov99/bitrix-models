<?php

namespace Sholokhov\BitrixModels\Models;

use Exception;
use ReflectionException;

use Sholokhov\BitrixModels\Builder\EntityBuilder;
use Sholokhov\BitrixModels\DTO\ModelSettingsInterface;
use Sholokhov\BitrixModels\Exception\SystemException;
use Sholokhov\BitrixModels\Providers\Query;

use Sholokhov\BitrixOption\Manager as SettingsManager;
use Sholokhov\BitrixOption\Builder\Loader as SettingsLoader;
use Sholokhov\BitrixOption\Exception\ConfigurationNotFoundException;
use Sholokhov\BitrixOption\Exception\InvalidValueException;

use Bitrix\Main\Result;

/**
 * Менеджер моделей, используется для возможности управления настройками модели и регистрации новой.
 * Дополнительно присутствует возможность выполнять простые запросы к ресурсу модели (ИБ, Справочник и т.д.)
 * Для этого предусмотрена функция {@see static::getQueryProvider()}
 * Все дополнительные запросы уже находятся внутри необходимой модели.
 * Благодаря менеджеру можем получить доступ к настройкам модели {@see static::getSettings()}
 * При необходимостри моджем получит достпу к настрйокам группы к которой относится текущая модель {@see static::getSettingsProvider()}
 * {@see static::getSettings()} является оберткой над {@see static::getSettingsProvider()}
 * из-за чего нам не нужно явно указывать некоторые данные в функции.
 */
class Manager
{
    /**
     * Объект модели
     *
     * @var string
     */
    private readonly string $entity;

    /**
     * Провайдер настроек модели
     *
     * @var SettingsManager
     */
    private readonly SettingsManager $settingsProvider;

    /**
     * @param string $entity
     * @param string|null $siteID
     * @throws ConfigurationNotFoundException
     * @throws InvalidValueException
     * @throws ReflectionException
     */
    public function __construct(string $entity, ?string $siteID = null)
    {
        $this->entity = $entity;
        $this->settingsProvider = SettingsLoader::loadByEntity($entity, $siteID);
    }

    /**
     * Создание объекта модели
     *
     * @return ModelInterface
     * @throws ReflectionException
     */
    public function make(): ModelInterface
    {
        return EntityBuilder::make($this->getEntity(), $this->settingsProvider->getSiteID());
    }

    /**
     * Сохранение настроек модели
     *
     * @return Result
     * @throws Exception
     */
    public function save(): Result
    {
        return $this->settingsProvider->save();
    }

    /**
     * Получение конструктора запроса
     *
     * @return object
     * @throws SystemException
     */
    public function getQueryProvider(): object
    {
        return Query\Builder::make($this->getEntity(), $this->getSettings());
    }

    /**
     * Получение настроек модели
     *
     * @return ModelSettingsInterface
     * @throws SystemException
     */
    public function getSettings(): ModelSettingsInterface
    {
        $settings = $this->settingsProvider->get();

        if (!($settings instanceof ModelSettingsInterface)) {
            throw new SystemException('Model settings store does not implement interface ' . ModelSettingsInterface::class);
        }

        return $settings;
    }

    /**
     * ID сайта модели, с которой работает менеджер
     *
     * @return string
     */
    public function getSiteID(): string
    {
        return $this->settingsProvider->getSiteID();
    }

    /**
     * Класс модели
     *
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }
}