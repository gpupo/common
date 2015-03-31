<?php

/*
 * This file is part of common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Tests\Common\Entity;

use Gpupo\Common\Entity\Collection;
use Gpupo\Tests\Common\TestCaseAbstract;

class CollectionTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderInformacao
     */
    public function testPossuiEstruturaDeInformacao($value)
    {
        $collection = new Collection();
        $collection->set('foo', $value);
        $this->assertEquals($value, $collection->get('foo'));
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
