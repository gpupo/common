<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <g@g1mr.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * For more information, see <http://www.g1mr.com/>.
 */

namespace Gpupo\Tests\Common\Entity;

use Gpupo\Common\Entity\Collection;
use Gpupo\Tests\Common\TestCaseAbstract;

class CollectionTest extends TestCaseAbstract
{
    public function testPossuiAcessoSingleton()
    {
        $collection = Collection::getInstance();
        $this->assertInstanceOf('Gpupo\Common\Entity\Collection', $collection);

        return $collection;
    }

    /**
     * @depends testPossuiAcessoSingleton
     */
    public function testPossuiMétodosGettersESettersMágicos(Collection $collection)
    {
        $collection->setFoo('bar');
        $this->assertSame('bar', $collection->getFoo());
    }

    /**
     * @depends testPossuiAcessoSingleton
     */
    public function testMétodosGettersMágicosPossibilitamAcessoAPropriedadesCamelCaseOuSnakeCase(Collection $collection)
    {
        $collection->set('foO', 'bar');
        $this->assertSame('bar', $collection->getFoO());
        $collection->set('ze_ta', 'jones');
        $this->assertSame('jones', $collection->getZeTa());
    }

    /**
     * @dataProvider dataProviderInformacao
     */
    public function testPossuiEstruturaDeInformacao($value)
    {
        $collection = new Collection();
        $collection->set('foo', $value);
        $this->assertSame($value, $collection->get('foo'));
    }

    public function dataProviderInformacao()
    {
        return [
            ['hello'],
            ['1'],
            ['1.8'],
        ];
    }
}
