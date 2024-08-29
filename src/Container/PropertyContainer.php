<?php

namespace Sholokhov\BitrixModels\Container;

class PropertyContainer extends Container
{
    public function __get(string $name)
    {
        return $this[$name];
    }

    public function __set(string $name, mixed $value)
    {
        $this[$name] = $value;
    }
}