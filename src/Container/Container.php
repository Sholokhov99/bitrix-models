<?php

namespace Sholokhov\BitrixModels\Container;

class Container implements \ArrayAccess
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
        return isset($this[$id]);
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
        return $this[$id] ?? $default;
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
        $this[$id] = $value;
        return $this;
    }

    /**
     * Проверка наличия значения по ключу
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * Получение значения значения по ключу
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * Установка значения
     *
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->data[$offset] = $value;
    }

    /**
     * Удаление значения по ключу
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        if (isset($this[$offset])) {
            unset($this->data[$offset]);
        }
    }
}