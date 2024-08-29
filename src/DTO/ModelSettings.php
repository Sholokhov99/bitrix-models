<?php

namespace Sholokhov\BitrixModels\DTO;

use Sholokhov\BitrixModels\Container\Container;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ModelSettings extends AbstractModelSettings implements ModelSettingsInterface
{

    public function __toString(): string
    {
        $normalizer = new ObjectNormalizer();

        return $normalizer->normalize()

        $id = $this->getID();
        $code = $this->getCode();
        $entity = $this->getEntity();

        return json_encode(compact('id', 'code', 'entity'));
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
     * @throws ExceptionInterface
     */
    public static function fromString(string $value): self
    {
        $normalizer = new ObjectNormalizer();
        return $normalizer->denormalize($value, self::class, 'json');
    }

    /**
     * Нормализация
     *
     * @param array $data
     * @return array
     */
    protected static function normalize(array $data): array
    {
        return $data;
    }
}