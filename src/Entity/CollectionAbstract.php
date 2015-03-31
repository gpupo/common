<?php

/*
 * This file is part of common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gpupo\Common\Traits\MagicCallTrait;

abstract class CollectionAbstract extends ArrayCollection
{
    use MagicCallTrait;

    public function toArray()
    {
        $list = parent::toArray();

        foreach ($list as $key => $value) {
            if ($value instanceof CollectionAbstract) {
                $list[$key] = $value->toArray();
            }
        }

        return $list;
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
