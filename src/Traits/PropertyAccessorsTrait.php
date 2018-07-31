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

use Gpupo\Common\Tools\StringTool;

trait PropertyAccessorsTrait
{
    protected $propertyNamingMode = 'lowerCamelCase';

    private function __accessorPropertyValidate($method, $property = null, $defaultValue = null)
    {
        if (empty($property) || !property_exists(get_called_class(), $property)) {
            if (null !== $defaultValue) {
                return false;
            }

            throw new \BadMethodCallException('There is no magic method '.$method.'() for '.get_called_class().'::$'.$property);
        }

        return true;
    }

    protected function __propertyNameNormalizer($property)
    {
        if(empty($property)) {
            return;
        }

        $property[0] = strtolower($property[0]);

        if ('snake_case' === $this->propertyNamingMode) {
            $property = StringTool::camelCaseToSnakeCase($property);
        }

        return $property;
    }

    protected function __accessorGetter($property, $defaultValue = null)
    {
        if (true === $this->__accessorPropertyValidate('__get', $property, $defaultValue)) {
            return $this->{$property};
        }

        return $defaultValue;
    }

    public function __get($property)
    {
        return $this->__accessorGetter($property);
    }

    public function __set($property, $value)
    {
        $this->__accessorPropertyValidate('__set', $property);
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

        if ('_' === $command[0]) {
            throw new \BadMethodCallException('Magic methods start with _ is not allowed');
        }

        if ('id' === $method) {
            $property = $method;
            $command = 'get';
        } else {
            $property = $this->__propertyNameNormalizer(substr($method, 3));
        }

        $argument = (is_array($args) && !empty($args)) ? current($args) : null;

        if ('set' === $command) {
            return $this->__set($property, $argument);
        }
        if ('has' === $command) {
            $value = $this->__accessorGetter($property);

            return !empty($value);
        }
        if ('get' === $command) {
            return $this->__accessorGetter($property, $argument);
        }

        $this->__accessorPropertyValidate($method);
    }
}
