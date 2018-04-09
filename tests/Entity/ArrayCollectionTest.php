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

namespace Gpupo\Tests\Common\Entity;

use Gpupo\Common\Entity\ArrayCollection;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * Minimal Based version of the test of Doctrine\Common\Collections\ArrayCollection
 * For more information, see <http://www.doctrine-project.org>.
 *
 * @coversNothing
 */
class ArrayCollectionTest extends TestCaseAbstract
{
    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testToArray($elements)
    {
        $collection = new ArrayCollection($elements);

        $this->assertSame($elements, $collection->toArray());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testFirst($elements)
    {
        $collection = new ArrayCollection($elements);
        $this->assertSame(reset($elements), $collection->first());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testLast($elements)
    {
        $collection = new ArrayCollection($elements);
        $this->assertSame(end($elements), $collection->last());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testKey($elements)
    {
        $collection = new ArrayCollection($elements);

        $this->assertSame(key($elements), $collection->key());

        next($elements);
        $collection->next();

        $this->assertSame(key($elements), $collection->key());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testNext($elements)
    {
        $collection = new ArrayCollection($elements);

        while (true) {
            $collectionNext = $collection->next();
            $arrayNext = next($elements);

            if (!$collectionNext || !$arrayNext) {
                break;
            }

            $this->assertSame($arrayNext, $collectionNext, 'Returned value of ArrayCollection::next() and next() not match');
            $this->assertSame(key($elements), $collection->key(), 'Keys not match');
            $this->assertSame(current($elements), $collection->current(), 'Current values not match');
        }
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testCurrent($elements)
    {
        $collection = new ArrayCollection($elements);

        $this->assertSame(current($elements), $collection->current());

        next($elements);
        $collection->next();

        $this->assertSame(current($elements), $collection->current());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testGetKeys($elements)
    {
        $collection = new ArrayCollection($elements);

        $this->assertSame(array_keys($elements), $collection->getKeys());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testGetValues($elements)
    {
        $collection = new ArrayCollection($elements);

        $this->assertSame(array_values($elements), $collection->getValues());
    }

    /**
     * @dataProvider provideDifferentElements
     *
     * @param mixed $elements
     */
    public function testCount($elements)
    {
        $collection = new ArrayCollection($elements);

        $this->assertSame(count($elements), $collection->count());
    }

    /**
     * @return array
     */
    public function provideDifferentElements()
    {
        return [
            'indexed' => [[1, 2, 3, 4, 5]],
            'associative' => [['A' => 'a', 'B' => 'b', 'C' => 'c']],
            'mixed' => [['A' => 'a', 1, 'B' => 'b', 2, 3]],
        ];
    }

    public function testRemove()
    {
        $elements = [1, 'A' => 'a', 2, 'B' => 'b', 3];
        $collection = new ArrayCollection($elements);

        $this->assertSame(1, $collection->remove(0));
        unset($elements[0]);

        $this->assertNull($collection->remove('non-existent'));
        unset($elements['non-existent']);

        $this->assertSame(2, $collection->remove(1));
        unset($elements[1]);

        $this->assertSame('a', $collection->remove('A'));
        unset($elements['A']);

        $this->assertSame($elements, $collection->toArray());
    }

    public function testRemoveElement()
    {
        $elements = [1, 'A' => 'a', 2, 'B' => 'b', 3, 'A2' => 'a', 'B2' => 'b'];
        $collection = new ArrayCollection($elements);

        $this->assertTrue($collection->removeElement(1));
        unset($elements[0]);

        $this->assertFalse($collection->removeElement('non-existent'));

        $this->assertTrue($collection->removeElement('a'));
        unset($elements['A']);

        $this->assertTrue($collection->removeElement('a'));
        unset($elements['A2']);

        $this->assertSame($elements, $collection->toArray());
    }

    public function testContainsKey()
    {
        $elements = [1, 'A' => 'a', 2, 'null' => null, 3, 'A2' => 'a', 'B2' => 'b'];
        $collection = new ArrayCollection($elements);

        $this->assertTrue($collection->containsKey(0), 'Contains index 0');
        $this->assertTrue($collection->containsKey('A'), 'Contains key "A"');
        $this->assertTrue($collection->containsKey('null'), 'Contains key "null", with value null');
        $this->assertFalse($collection->containsKey('non-existent'), "Doesn't contain key");
    }

    public function testEmpty()
    {
        $collection = new ArrayCollection();
        $this->assertTrue($collection->isEmpty(), 'Empty collection');

        $collection->add(1);
        $this->assertFalse($collection->isEmpty(), 'Not empty collection');
    }

    public function testContains()
    {
        $elements = [1, 'A' => 'a', 2, 'null' => null, 3, 'A2' => 'a', 'zero' => 0];
        $collection = new ArrayCollection($elements);

        $this->assertTrue($collection->contains(0), 'Contains Zero');
        $this->assertTrue($collection->contains('a'), 'Contains "a"');
        $this->assertTrue($collection->contains(null), 'Contains Null');
        $this->assertFalse($collection->contains('non-existent'), "Doesn't contain an element");
    }

    public function testExists()
    {
        $elements = [1, 'A' => 'a', 2, 'null' => null, 3, 'A2' => 'a', 'zero' => 0];
        $collection = new ArrayCollection($elements);

        $this->assertTrue($collection->exists(function ($key, $element) {
            return 'A' === $key && 'a' === $element;
        }), 'Element exists');

        $this->assertFalse($collection->exists(function ($key, $element) {
            return 'non-existent' === $key && 'non-existent' === $element;
        }), 'Element not exists');
    }

    public function testIndexOf()
    {
        $elements = [1, 'A' => 'a', 2, 'null' => null, 3, 'A2' => 'a', 'zero' => 0];
        $collection = new ArrayCollection($elements);

        $this->assertSame(array_search(2, $elements, true), $collection->indexOf(2), 'Index of 2');
        $this->assertSame(array_search(null, $elements, true), $collection->indexOf(null), 'Index of null');
        $this->assertSame(array_search('non-existent', $elements, true), $collection->indexOf('non-existent'), 'Index of non existent');
    }

    public function testGet()
    {
        $elements = [1, 'A' => 'a', 2, 'null' => null, 3, 'A2' => 'a', 'zero' => 0];
        $collection = new ArrayCollection($elements);

        $this->assertSame(2, $collection->get(1), 'Get element by index');
        $this->assertSame('a', $collection->get('A'), 'Get element by name');
        $this->assertNull($collection->get('non-existent'), 'Get non existent element');
    }
}
