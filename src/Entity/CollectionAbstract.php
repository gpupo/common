<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://www.gpupo.com/>.
 */

namespace Gpupo\Common\Entity;

use Gpupo\Common\Traits\MagicCallTrait;
use Gpupo\Common\Traits\SingletonTrait;

abstract class CollectionAbstract extends ArrayCollection
{
    use MagicCallTrait;
    use SingletonTrait;

    /**
     * Aplica empty() a um elemento interno.
     */
    public function elementEmpty($key)
    {
        if (!$this->containsKey($key)) {
            return true;
        }

        $value = $this->get($key);

        return empty($value);
    }

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

    protected function partitionByArrayKey(array $allowed)
    {
        $new = [];
        $list = $this->toArray();
        foreach ($list as $key => $value) {
            if (in_array($key, $allowed, true)) {
                $new[$key] = $value;
            }
        }

        return $new;
    }

    /**
     * @see http://php.net/manual/en/function.json-encode.php
     */
    public function toJson($route = null, $options = 0, $depth = 512)
    {
        if (empty($route) || $route === 'save') {
            $data = $this->toArray();
        } else {
            $method = 'to'.ucfirst($route);
            $data = $this->$method();
        }

        return json_encode($data, $options, $depth);
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
