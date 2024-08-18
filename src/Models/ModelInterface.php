<?php

namespace Sholokhov\BitrixModels\Models;

use Sholokhov\BitrixModels\Attributes\OptionProvider;
use Sholokhov\BitrixModels\Attributes\QueryProvider;

use Sholokhov\BitrixOption\Attributes\Option;

/**
 * Базовое описание структуры модели
 *
 * Модель - описание некой сущности, в качестве сущности может выступать информационный блок, правочник и т.д.
 * Указанный интерфейс может использовапться вне пакета и будет поддерживаться обратная совместимость на сколько это возможно.
 *
 * Каждая модель должна иметь атрибуты описывающие его работу:
 * <li>{@see QueryProvider} - Используемый сборщик запросов</li>
 * <li>{@see OptionProvider} - Используемый провайдер настроек</li>
 * <li>{@see Option} - Конфигурация поиска настроек модели</li>
 */
interface ModelInterface
{
    /**
     * Флаг возможности работы с моделью.
     *
     * За данное состояние может овечать множество фактороф, одними из таких:
     * <li>Модуль с которым ваимодействует модель не установлен</li>
     * <li>Отсутствуют настройки модели</li>
     * <li>У нее нет настроения</li>
     * <li>и т.д.</li>
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Получение сборщика запроса
     *
     * @return object
     */
    public function query(): object;

    /**
     * Идентификатор сайта к которому относится модель
     *
     * @return string
     */
    public function getSiteID(): string;

    /**
     * Получение идентификатора модели
     *
     * В качетсве идентификатора может выступать:
     * <li>ID инфоблока</li>
     * <li>ID справочника</li>
     * <li>Символьный код медиабиблиотеки</li>
     * <li>и т.д.</li>
     *
     * @return string
     */
    public function getID(): string;
}