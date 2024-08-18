<?php

namespace Sholokhov\BitrixModels\Providers\Settings;

use Exception;

use Sholokhov\BitrixOption\Manager;
use Sholokhov\BitrixModels\Exception\SystemException;

use Bitrix\Main\Result;

/**
 * Указанная абстракция может использовапться вне пакета и будет поддерживаться обратная совместимость на сколько это возможно.
 */
abstract class AbstractSettings implements SettingsProviderInterface
{
    public function __construct(protected readonly Manager $manager)
    {
    }

    /**
     * Сохранение настроек модели
     *
     * @return Result
     * @throws Exception
     */
    public function save(): Result
    {
        return $this->manager->save();
    }

    /**
     * Получение настроек модели по ее коду
     *
     * @param string $code
     * @return object
     * @throws SystemException
     */
    public function get(string $code): object
    {
        if (!$this->has($code)) {
            throw new SystemException('Settings not found');
        }

        return $this->getSection()[$code];
    }

    /**
     * Проверка наличия настроек модели
     *
     * @param string $code
     * @return bool
     */
    public function has(string $code): bool
    {
        return array_key_exists($code, $this->getSection());
    }

    /**
     * Получение идентификатора сайта которому относятся настройки
     *
     * @return string
     */
    public function getSiteID(): string
    {
        return $this->manager->getSiteID();
    }
}