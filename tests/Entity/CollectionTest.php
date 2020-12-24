<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Entity;

use Gpupo\Common\Entity\Collection;

/**
 * @coversNothing
 */
class CollectionTest extends ArrayCollectionTest
{
    public function testPossuiAcessoSingleton()
    {
        $collection = Collection::getInstance();
        $this->assertInstanceOf(Collection::class, $collection);

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
     *
     * @param mixed $value
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
