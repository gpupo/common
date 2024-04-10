<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Entity;

use ArrayAccess;
use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;

/**
 * Minimal/modified Based version of the object Doctrine\Common\Collections\ArrayCollection
 * For more information, see <http://www.doctrine-project.org>.
 */
class ArrayCollection implements Countable, IteratorAggregate, ArrayAccess, \Stringable
{
    /**
     * Initializes a new ArrayCollection.
     */
    public function __construct(
        /**
         * An array containing the entries of this collection.
         */
        private array $elements = []
    )
    {
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    #[\Override]
    public function __toString(): string
    {
        return self::class.'@'.spl_object_hash($this);
    }

    public function toArray()
    {
        return (array) $this->elements;
    }

    public function first()
    {
        return reset($this->elements);
    }

    public function last()
    {
        return end($this->elements);
    }

    public function key()
    {
        return key($this->elements);
    }

    public function next()
    {
        return next($this->elements);
    }

    public function current()
    {
        return current($this->elements);
    }

    public function remove($key)
    {
        if (!isset($this->elements[$key]) && !\array_key_exists($key, $this->elements)) {
            return;
        }

        $removed = $this->elements[$key];
        unset($this->elements[$key]);

        return $removed;
    }

    public function removeElement($element)
    {
        $key = array_search($element, $this->elements, true);

        if (false === $key) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * Required by interface ArrayAccess.
     */
    #[\Override]
    public function offsetExists(mixed $offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * Required by interface ArrayAccess.
     */
    #[\Override]
    public function offsetGet(mixed $offset)
    {
        return $this->get($offset);
    }

    /**
     * Required by interface ArrayAccess.
     */
    #[\Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!isset($offset)) {
            $this->add($value);
        }

        $this->set($offset, $value);
    }

    /**
     * Required by interface ArrayAccess.
     */
    #[\Override]
    public function offsetUnset(mixed $offset)
    {
        return $this->remove($offset);
    }

    public function containsKey($key)
    {
        if (empty($this->elements)) {
            return false;
        }

        return isset($this->elements[$key]) || \array_key_exists($key, $this->elements);
    }

    public function contains($element)
    {
        return \in_array($element, $this->elements, true);
    }

    public function exists(Closure $p)
    {
        foreach ($this->elements as $key => $element) {
            if ($p($key, $element)) {
                return true;
            }
        }

        return false;
    }

    public function indexOf($element)
    {
        return array_search($element, $this->elements, true);
    }

    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    public function getKeys()
    {
        return array_keys($this->elements);
    }

    public function getValues()
    {
        return array_values($this->elements);
    }

    #[\Override]
    public function count()
    {
        return \count($this->elements);
    }

    public function set($key, $value)
    {
        $this->elements[$key] = $value;
    }

    public function add($value)
    {
        $this->elements[] = $value;

        return true;
    }

    public function isEmpty()
    {
        return empty($this->elements);
    }

    /**
     * Required by interface IteratorAggregate.
     */
    #[\Override]
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    public function map(Closure $func)
    {
        return new static(array_map($func, $this->elements));
    }

    public function filter(Closure $p)
    {
        return new static(array_filter($this->elements, $p));
    }

    public function forAll(Closure $p)
    {
        foreach ($this->elements as $key => $element) {
            if (!$p($key, $element)) {
                return false;
            }
        }

        return true;
    }

    public function partition(Closure $p)
    {
        $matches = $noMatches = [];

        foreach ($this->elements as $key => $element) {
            if ($p($key, $element)) {
                $matches[$key] = $element;
            } else {
                $noMatches[$key] = $element;
            }
        }

        return [new static($matches), new static($noMatches)];
    }

    public function clear()
    {
        $this->elements = [];
    }

    public function slice($offset, $length = null)
    {
        return \array_slice($this->elements, $offset, $length, true);
    }

    protected function all()
    {
        return $this->elements;
    }
}
