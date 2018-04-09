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

/**
 * Acesso mágico a elementos.
 */
trait MagicCallTrait
{
    private function __magicResolvGetter($field, callable $exception)
    {
        if ($this->containsKey($field)) {
            return $this->get($field);
        }
        $snake = StringTool::camelCaseToSnakeCase($field);

        if ($this->containsKey($snake)) {
            return $this->get($snake);
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
        $field = substr($method, 3);
        $field[0] = strtolower($field[0]);

        if ('set' === $command) {
            $this->set($field, current($args));

            return $this;
        }
        if ('get' === $command) {
            return $this->__magicResolvGetter($field, $exception);
        }
        if ('add' === $command) {
            $this->add($field, current($args));

            return $this;
        }

        $exception();
    }

    abstract public function get($key);

    abstract public function set($key, $value);

    abstract public function add($value);

    abstract public function containsKey($key);
}
