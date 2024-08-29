<?php

namespace Sholokhov\BitrixModels\DTO;

use Exception;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ModelSettings extends AbstractModelSettings implements ModelSettingsInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::makeSerializer()
                   ->serialize($this, JsonEncoder::FORMAT);
    }

    /**
     * Преобразование данных в строкове представление
     *
     * @return string
     */
    public function toString(): string
    {
        return (string)$this;
    }

    /**
     * Создание объекта настроек на основе DTO
     *
     * @param string $value
     * @return self
     */
    public static function fromString(string $value): self
    {
        try {
            $entity = self::makeSerializer()
                          ->deserialize($value, self::class, JsonEncoder::FORMAT);
        } catch (Exception) {
            $entity = new self;
        }

        return $entity;
    }

    /**
     * Создание конвертатора данных
     *
     * @return Serializer
     */
    protected static function makeSerializer(): Serializer
    {
        return new Serializer([new ObjectNormalizer], [new JsonEncoder()]);
    }
}