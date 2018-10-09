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
    protected $object;

    public function export()
    {
        return $this->object;
    }

    public function __construct($object)
    {
        if (!\is_object($object)) {
            throw new InvalidArgumentException('Argument must be an object');
        }

        $this->object = $object;
    }

    public function __call($name, array $arguments)
    {
        $method = new ReflectionMethod($this->object, $name);
        $method->setAccessible(true);

        return $method->invokeArgs($this->object, $arguments);
    }

    public function __get($name)
    {
        return $this->setPropertyAccessible($name)->getValue($this->object);
    }

    public function __set($name, $value)
    {
        $this->setPropertyAccessible($name)->setValue($this->object, $value);
    }

    private function setPropertyAccessible($name)
    {
        $property = new ReflectionProperty($this->object, $name);
        $property->setAccessible(true);

        return $property;
    }
}
