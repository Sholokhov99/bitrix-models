<?php

namespace Sholokhov\BitrixModels\Providers\Settings;

use ReflectionException;

use Sholokhov\BitrixModels\Helpers\Attribute;
use Sholokhov\BitrixModels\Builder\EntityBuilder;
use Sholokhov\BitrixModels\Attributes\OptionProvider;
use Sholokhov\BitrixModels\Exception\SystemException;

use Sholokhov\BitrixOption\Builder\Loader;
use Sholokhov\BitrixOption\Exception\ConfigurationNotFoundException;
use Sholokhov\BitrixOption\Exception\InvalidValueException;

/**
 * Создание объекта настроек модели
 */
class Builder
{
    /**
     * Создание объекта
     *
     * @param string $entity
     * @param string $siteID
     * @return SettingsProviderInterface
     * @throws SystemException
     * @throws ReflectionException
     * @throws ConfigurationNotFoundException
     * @throws InvalidValueException
     */
    public static function make(string $entity, string $siteID): SettingsProviderInterface
    {
        $attribute = current(Attribute::get($entity, OptionProvider::class)) ?: null;

        if (!$attribute) {
            throw new SystemException("Settings initialization configuration missing");
        }

        if (!($attribute instanceof OptionProvider)) {
            throw new SystemException('Attribute not implemented ' . OptionProvider::class);
        }

        if (!($attribute->entity instanceof SettingsProviderInterface)) {
            throw new SystemException('Provider not implemented' . SettingsProviderInterface::class);
        }

        $option = Loader::loadByEntity($entity, $siteID);

        return EntityBuilder::make($attribute->entity, $option);
    }
}