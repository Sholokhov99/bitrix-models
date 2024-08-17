<?php

namespace Sholokhov\BitrixModels\Models;

use ReflectionException;

use Sholokhov\BitrixModels\Builder\QueryBuilder;
use Sholokhov\BitrixModels\Container\Container;

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
     * Используемые провайдеры
     *
     * @var Container
     */
    private Container $providers;

    public function __construct(
        private readonly string $entity,
        private readonly object $settingsManager
    )
    {
        $this->providers = new Container();
    }

    /**
     * Создание объекта модели
     *
     * @return ModelInterface
     * @throws ReflectionException
     */
    public function make(): ModelInterface
    {
        $reflection = new \ReflectionClass($this->entity);
        return $reflection->newInstance($this->settingsManager->getSiteID());
    }

    /**
     * Сохранение настроек модели
     *
     * @return bool
     */
    public function save(): bool
    {
        return $this->settingsManager->save();
    }

    /**
     * Получение конструктора запроса
     *
     * @return object
     */
    public function getQueryProvider(): object
    {
        $builder = new QueryBuilder($this->getEntity(), $this->getModelSettings());
        return $builder->make();
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
     * @return object
     */
    public function getSettingsProvider(): object
    {
        return $this->getProvider('Settings');
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

    /**
     * Получение используемого провайдера
     *
     * @param string $code
     * @return object
     */
    public function getProvider(string $code): object
    {
        return $this->providers->get($code);
    }
}