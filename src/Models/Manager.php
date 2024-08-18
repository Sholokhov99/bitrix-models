<?php

namespace Sholokhov\BitrixModels\Models;

use Exception;
use ReflectionException;

use Sholokhov\BitrixModels\Builder\EntityBuilder;
use Sholokhov\BitrixModels\Providers\Settings;
use Sholokhov\BitrixModels\Providers\Query;
use Sholokhov\BitrixModels\Exception\SystemException;

use Sholokhov\BitrixOption\Exception\ConfigurationNotFoundException;
use Sholokhov\BitrixOption\Exception\InvalidValueException;

use Bitrix\Main\Result;

/**
 * Менеджер моделей, используется для возможности управления настройками модели и регистрации новой.
 * Дополнительно присутствует возможность выполнять простые запросы к ресурсу модели (ИБ, Справочник и т.д.)
 * Для этого предусмотрена функция {@see static::getQueryProvider()}
 * Все дополнительные запросы уже находятся внутри необходимой модели.
 * Благодаря менеджеру можем получить доступ к настройкам модели {@see static::getModelSettings()}
 * При необходимостри моджем получит достпу к настрйокам группы к которой относится текущая модель {@see static::getSettingsProvider()}
 * {@see static::getModelSettings()} является оберткой над {@see static::getSettingsProvider()}
 * из-за чего нам не нужно явно указывать некоторые данные в функции.
 */
class Manager
{
    /**
     * Объект модели
     *
     * @var string
     */
    private string $entity;

    /**
     * Провайдер настроек модели
     *
     * @var Settings\SettingsProviderInterface
     */
    private Settings\SettingsProviderInterface $settingsProvider;

    /**
     * @param string $entity
     * @param string|null $siteID
     * @throws ReflectionException
     * @throws SystemException
     * @throws ConfigurationNotFoundException
     * @throws InvalidValueException
     */
    public function __construct(string $entity, ?string $siteID = null)
    {
        $this->entity = $entity;
        $this->settingsProvider = Settings\Builder::make($entity, $siteID);
    }

    /**
     * Создание объекта модели
     *
     * @return ModelInterface
     * @throws ReflectionException
     */
    public function make(): ModelInterface
    {
        return EntityBuilder::make($this->getEntity(), $this->getSettingsProvider()->getSiteID());
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
     */
    public function getQueryProvider(): object
    {
        return Query\Builder::make($this->getEntity(), $this->getModelSettings());
    }

    /**
     * Получение настроек модели
     *
     * @return object
     */
    public function getModelSettings(): object
    {
        return $this->getSettingsProvider()->get($this->getEntityCode());
    }

    /**
     * Получение провайдера настроек
     *
     * @return Settings\SettingsProviderInterface
     */
    public function getSettingsProvider(): Settings\SettingsProviderInterface
    {
        return $this->settingsProvider;
    }

    /**
     * Символьный код модели
     *
     * Используется, для идентификации настроек
     *
     * @return string
     */
    public function getEntityCode(): string
    {
        return '';
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