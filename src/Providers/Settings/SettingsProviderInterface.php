<?php

namespace Sholokhov\BitrixModels\Providers\Settings;

use Sholokhov\BitrixModels\Providers\ProviderInterface;

use Bitrix\Main\Result;

/**
 * Провайдер предоставляющий доступ к настройкам модели
 *
 * Указанный интерфейс может использовапться вне пакета и будет поддерживаться обратная совместимость на сколько это возможно.
 */
interface SettingsProviderInterface extends ProviderInterface
{
    /**
     * Получение раздела модули
     *
     * @return object[]
     */
    public function getSection(): array;

    /**
     * Получение настроек по умолчанию
     *
     * @return object
     */
    public function getDefaultSettings(): object;

    /**
     * Добавление настроек модели
     *
     * @param object $settings
     * @param string $code
     * @return bool
     */
    public function add(object $settings, string $code): bool;

    /**
     * Обновление настроек модели
     *
     * @param object $settings
     * @param string $code
     * @return Result
     */
    public function update(object $settings, string $code): Result;

    /**
     * Сохранение настроек модели
     *
     * @return Result
     */
    public function save(): Result;

    /**
     * Получение настроек модели по ее коду
     *
     * @param string $code
     * @return object
     */
    public function get(string $code): object;

    /**
     * Проверка наличия настроек модели
     *
     * @param string $code
     * @return bool
     */
    public function has(string $code): bool;

    /**
     * Получение идентификатора сайта которому относятся настройки
     *
     * @return string
     */
    public function getSiteID(): string;
}