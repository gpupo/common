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
        $exception = function () use ($method) {
            throw new \BadMethodCallException('There is no [magic] method '.$method.'()');
        };

        $command = substr($method, 0, 3);
        $property = substr($method, 3);
        $property[0] = strtolower($property[0]);

        if ('set' === $command) {
            if ($this->__accessorPropertyExists($property)) {
                $this->{$property} = current($args);

                return true;
            }
        } elseif ('has' === $command) {
            $value = $this->__accessorPropertyGetter($property, $exception);

            return !empty($value);
        } elseif ('get' === $command) {
            return $this->__accessorPropertyGetter($property, $exception);
        }

        $exception();
    }
}
