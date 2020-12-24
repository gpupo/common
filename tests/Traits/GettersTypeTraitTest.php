<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Tests\Objects\HasGettersTypeTrait;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class GettersTypeTraitTest extends TestCaseAbstract
{
    public function testGetTypeFloat()
    {
        $object = new HasGettersTypeTrait(['foo' => '11']);
        $this->assertSame(11., $object->getTypeFloat('foo'));

        $object->set('foo', '00');
        $this->assertNull($object->getTypeFloat('foo'));
    }

    public function testGetTypeBoolean()
    {
        $object = new HasGettersTypeTrait();

        foreach ([
                'yes' => true,
                '1' => true,
                '0' => false,
                'true' => true,
                'OK' => true,
                's' => false,
            ] as $k => $v) {
            $object->set('foo', $k);
            $b = $object->getTypeBoolean('foo');
            $this->assertIsBool($b);
            $this->assertSame($v, $b);
        }

        $object->set('foo', true);
        $b = $object->getTypeBoolean('foo');
        $this->assertIsBool($b);
        $this->assertTrue($b);

        $object->set('foo', false);
        $b = $object->getTypeBoolean('foo');
        $this->assertIsBool($b);
        $this->assertFalse($b);
    }
}
