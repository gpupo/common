<?php

/*
 * This file is part of gpupo/common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For more information, see
 * <http://www.g1mr.com/common/>.
 */

namespace Gpupo\Common\Traits;

use Gpupo\Tools\String;

trait MagicCallTrait
{
    protected function magicResolvGetter($field)
    {
        if ($this->containsKey($field)) {
            return $this->get($field);
        } elseif ($this->containsKey($field=String::camelCaseToSnakeCase($field))) {
            return $this->get($field);
        }

        return false;
    }

    /**
     * Magic method that implements.
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
        $field = substr($method, 3);
        $field[0] = strtolower($field[0]);

        if ($command === 'set') {
            $this->set($field, current($args));

            return $this;
        } elseif ($command === 'get') {
            return $this->magicResolvGetter($field);
        } elseif ($command === 'add') {
            $this->add($field, current($args));

            return $this;
        } else {
            throw new \BadMethodCallException('There is no method '.$method);
        }
    }
}
