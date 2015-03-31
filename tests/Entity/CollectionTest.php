<?php

namespace Gpupo\Tests\Common\Entity;

use Gpupo\Tests\Common\TestCaseAbstract;
use Gpupo\Common\Entity\Collection;

class CommonTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderInformacao
     */
    public function testPossuiEstruturaDeInformacao($value)
    {
        $collection = new Collection;
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
