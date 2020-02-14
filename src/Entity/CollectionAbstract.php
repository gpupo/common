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

namespace Gpupo\Common\Entity;

use Gpupo\Common\Traits\MagicCallTrait;
use Gpupo\Common\Traits\SingletonTrait;

abstract class CollectionAbstract extends ArrayCollection
{
    use MagicCallTrait;
    use SingletonTrait;

    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Aplica empty() a um elemento interno.
     */
    public function elementEmpty(string $key): bool
    {
        if (!$this->containsKey($key)) {
            return true;
        }

        $value = $this->get($key);

        return empty($value);
    }

    public function toArray(): array
    {
        $list = parent::toArray();

        foreach ($list as $key => $value) {
            if ($value instanceof self || $value instanceof CollectionInterface || method_exists($value, 'toArray')) {
                $list[$key] = $value->toArray();
            }
        }

        return $list;
    }

    /**
     * Adiciona um elemento no final de um valor array existente.
     *
     * @param mixed $value
     */
    public function addToArrayValue(string $key, $value): void
    {
        $currentValue = $this->get($key);

        if (\is_array($currentValue)) {
            $currentValue[] = $value;
            $this->set($key, $currentValue);
        } else {
            throw new \LogicException("Elemento ${key} deve ser um array");
        }
    }

    public function toJson(string $route = null, int $options = 0, int $depth = 512): string
    {
        if (empty($route) || 'save' === $route) {
            $data = $this->toArray();
        } else {
            $method = 'to'.ucfirst($route);
            $data = $this->{$method}();
        }

        $encoded = json_encode($data, $options, $depth);
        if ($encoded === false && $data && json_last_error() == JSON_ERROR_UTF8) {
            $encoded = json_encode($this->utf8Resolve($data), $options, $depth);
        }

        return $encoded;
    }

    public function utf8Resolve($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8Resolve($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }

    public function toLog(): array
    {
        return $this->toArray();
    }

    protected function partitionByArrayKey(array $allowed): array
    {
        $new = [];
        $list = $this->toArray();
        foreach ($list as $key => $value) {
            if (\in_array($key, $allowed, true)) {
                $new[$key] = $value;
            }
        }

        return $new;
    }

    protected function piece($key, $newKey = null): array
    {
        return [$newKey ?: $key => $this->get($key)];
    }
}
