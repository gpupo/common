<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools;

use ReflectionMethod;
use ReflectionProperty;

class Reflected
{
    const STATE_CLOSED = 0;
    const STATE_OPEN = 1;

    public function __construct(protected object $_object, private int $_state = 1)
    {
    }

    public function __call($method, $args)
    {
        if ($this->isReflectionOpen()) {
            return $this->reflectionCall($method, $args);
        }

        return $this->_object->{$method}($args);
    }

    public function __get($name)
    {
        return $this->setPropertyAccessible($name)->getValue($this->_object);
    }

    public function __set($name, $value)
    {
        $this->setPropertyAccessible($name)->setValue($this->_object, $value);
    }

    public function reflectionEnd()
    {
        $this->_state = $this::STATE_CLOSED;
    }

    public function export()
    {
        return $this->_object;
    }

    protected function isReflectionOpen()
    {
        return $this->_state === $this::STATE_OPEN;
    }

    protected function reflectionCall($name, array $arguments)
    {
        $method = new ReflectionMethod($this->_object, $name);
        $method->setAccessible(true);

        return $method->invokeArgs($this->_object, $arguments);
    }

    private function setPropertyAccessible($name)
    {
        $property = new ReflectionProperty($this->_object, $name);
        $property->setAccessible(true);

        return $property;
    }
}
