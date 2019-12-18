<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Common\Tools;

use InvalidArgumentException;
use ReflectionMethod;
use ReflectionProperty;

class Reflected
{
    const STATE_CLOSED = 0;
    const STATE_OPEN = 1;

    protected $_object;

    private $_state;

    public function __construct($object)
    {
        if (!\is_object($object)) {
            throw new InvalidArgumentException('Argument must be an object');
        }

        $this->_state = $this::STATE_OPEN;

        $this->_object = $object;
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
