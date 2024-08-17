<?php

declare(strict_types=1);

namespace Sholokhov\BitrixModels\Container;

class Container
{
    /**
     * Данные контейнера
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Проверка наличия значения по идентификатору
     *
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }

    /**
     * Получение значения
     *
     * @param string $id
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $id, mixed $default = null): mixed
    {
        return $this->data[$id] ?? $default;
    }

    /**
     * Установка значения
     *
     * @param string $id
     * @param mixed $value
     * @return $this
     */
    public function set(string $id, mixed $value): self
    {
        $this->data[$id] = $value;
        return $this;
    }
}