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

namespace Gpupo\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gpupo\Common\Traits\MagicCallTrait;
use Gpupo\Common\Traits\SingletonTrait;

abstract class CollectionAbstract extends ArrayCollection
{
    use MagicCallTrait;
    use SingletonTrait;

    public function toArray()
    {
        $list = parent::toArray();

        foreach ($list as $key => $value) {
            if ($value instanceof self) {
                $list[$key] = $value->toArray();
            }
        }

        return $list;
    }

    /**
     * Adiciona um elemento no final de um valor array existente.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws \LogicException
     */
    public function addToArrayValue($key, $value)
    {
        $currentValue = $this->get($key);

        if (is_array($currentValue)) {
            $currentValue[] = $value;
            $this->set($key, $currentValue);
        } else {
            throw new \LogicException("Elemento $key deve ser um array");
        }
    }

    public function toJson($route = null)
    {
        if (empty($route) || $route === 'save') {
            $data = $this->toArray();
        } else {
            $method = 'to'.ucfirst($route);
            $data = $this->$method();
        }

        return json_encode($data);
    }

    protected function piece($key, $newKey = null)
    {
        return [$newKey ?: $key => $this->get($key)];
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function toLog()
    {
        return $this->toArray();
    }
}
