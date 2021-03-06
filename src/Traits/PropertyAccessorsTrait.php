<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Traits;

use Gpupo\Common\Tools\StringTool;

trait PropertyAccessorsTrait
{
    protected $propertyNamingMode = 'lowerCamelCase';

    private function __accessorPropertyValidate($method, $property = null, $defaultValue = null)
    {
        if (empty($property)) {
            return false;
        }

        if (!property_exists(static::class, $property)) {
            if (null !== $defaultValue) {
                return false;
            }

            throw new \BadMethodCallException(sprintf('Property $%s not found in %s trying %s() in [%s] mode', $property, static::class, $method, $this->propertyNamingMode));
        }

        return true;
    }

    protected function __propertyNameNormalizer($property)
    {
        if (empty($property)) {
            return;
        }
        if ('snake_case' === $this->propertyNamingMode) {
            $property = StringTool::camelCaseToSnakeCase($property);
        } else {
            $property = StringTool::snakeCaseToCamelCase($property);
        }

        return $property;
    }

    protected function __accessorGetter($property, $defaultValue = null)
    {
        $property = $this->__propertyNameNormalizer($property);

        if (true === $this->__accessorPropertyValidate('__get', $property, $defaultValue)) {
            return $this->{$property};
        }

        return $defaultValue;
    }

    public function __get($property)
    {
        $concreteGetter = StringTool::snakeCaseToCamelCase('get_'.$property);

        if (method_exists(static::class, $concreteGetter)) {
            return $this->{$concreteGetter}();
        }

        return $this->__accessorGetter($property);
    }

    public function __set($property, $value)
    {
        $concreteSetter = StringTool::snakeCaseToCamelCase('set_'.$property);

        if (method_exists(static::class, $concreteSetter)) {
            $this->{$concreteSetter}($value);
        } else {
            $this->__accessorPropertyValidate('__set', $property);
            $this->{$property} = $value;
        }
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
        $command = mb_substr($method, 0, 3);

        if ('_' === $command[0]) {
            throw new \BadMethodCallException('Magic methods start with _ is not allowed');
        }

        if ('id' === $method) {
            $property = $method;
            $command = 'get';
        } else {
            $property = $this->__propertyNameNormalizer(mb_substr($method, 3));
        }

        $argument = (\is_array($args) && !empty($args)) ? current($args) : null;

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

        $this->__accessorPropertyValidate($this->__propertyNameNormalizer($method));
    }
}
