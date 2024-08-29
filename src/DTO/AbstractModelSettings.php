<?php

namespace Sholokhov\BitrixModels\DTO;

use Sholokhov\BitrixModels\Container\Container;

abstract class AbstractModelSettings implements ModelSettingsInterface
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * Получение идентификатора модели
     *
     * @return string
     */
    public function getID(): string
    {
        return $this->container->get('id', '');
    }

    /**
     * Получение символьного кода модели
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->container->get('code', '');
    }

    /**
     * Получение объекта модели
     *
     * @return string
     */
    public function getEntity(): string
    {
        return $this->container->get('entity', '');
    }

    /**
     * Указание идентификатора
     *
     * @param string $id
     * @return $this
     */
    public function setID(string $id): self
    {
        $this->container->set('id', $id);
        return $this;
    }

    /**
     * Указание символьного кода модели
     *
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->container->set('code', $code);
        return $this;
    }

    /**
     * Указание объекта модели
     *
     * @param string $entity
     * @return $this
     */
    public function setEntity(string $entity): self
    {
        $this->container->set('entity', $entity);
        return $this;
    }

    /**
     * Получение контейнера хранения данных
     *
     * @return Container
     */
    final protected function getContainer(): Container
    {
        return $this->container;
    }
}