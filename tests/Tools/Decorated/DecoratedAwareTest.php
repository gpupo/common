<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Tools\Decorated;

use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Datetime\Holidays;
use Gpupo\Common\Tools\Decorated\DecoratedAwareTrait;

/**
 * @coversNothing
 */
class DecoratedAwareTest extends TestCaseAbstract
{
    use DecoratedAwareTrait;

    public function testGetterSetterrs()
    {
        $object = new Holidays(new \DateTime());

        $this->assertNull($this->getDecorated());
        $this->assertTrue($this->setDecorated($object));
        $this->assertSame($object, $this->getDecorated());
    }
}
