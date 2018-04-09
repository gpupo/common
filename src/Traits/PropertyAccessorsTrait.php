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

namespace Gpupo\Common\Traits;

trait PropertyAccessorsTrait
{
    private function __accessorPropertyExists($property)
    {
        return property_exists(self::class, $property);
    }

    private function __accessorPropertyGetter($property, callable $exception)
    {
        if ($this->__accessorPropertyExists($property)) {
            return $this->{$property};
        }

        $exception();
    }

    private function __accessorPropertyException($method, $property = null)
    {
        if (empty($property) || !$this->__accessorPropertyExists($property)) {
            throw new \BadMethodCallException('There is no [magic] method '.$method.'()');
        }
    }

    public function __get($property)
    {
        if ($this->__accessorPropertyExists($property)) {
            return $this->{$property};
        }
    }

    public function __set($property, $value)
    {
        $this->{$property} = $value;

        return true;
    }

    /**
     * Magic method Hook.
     *
     * @param string $method
     * @param array  $args
     *
     * @throws \BadMethodCallException
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        $command = substr($method, 0, 3);
        $property = substr($method, 3);
        $property[0] = strtolower($property[0]);

        if ('set' === $command) {
            $this->__accessorPropertyException($method, $property);

            return $this->__set($property, current($args));
        }
        if ('has' === $command) {
            $this->__accessorPropertyException($method, $property);
            $value = $this->__get($property);

            return !empty($value);
        }
        if ('get' === $command) {
            $this->__accessorPropertyException($method, $property);

            return $this->__get($property);
        }

        $this->__accessorPropertyException($method);
    }
}
