<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Tools;

use DateTime;
use Gpupo\Common\Entity\Collection;
use Gpupo\Common\Tests\Objects\HasMagicCall;
use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Datetime\Holidays;
use Gpupo\Common\Tools\Reflected;

/**
 * @coversNothing
 */
class ReflectedTest extends TestCaseAbstract
{
    public function testAccessPrivateMethod()
    {
        $obj = new Collection([
            'foo' => 'bar',
            'king' => 'James',
        ]);

        $reflected = new Reflected($obj);

        $this->assertSame(['foo' => 'bar'], $reflected->partitionByArrayKey(['foo']));
    }

    public function testAccessPrivateProperty()
    {
        $datetime = new DateTime();
        $obj = new Holidays($datetime);

        $reflected = new Reflected($obj);

        $this->assertSame($datetime, $reflected->datetime);
    }

    public function testAccessPublicMagicMethods()
    {
        $arrayCollection = new HasMagicCall([
            'foo' => 'bar',
        ]);

        $this->assertSame('bar', $arrayCollection->getFoo());
        $reflected = new Reflected($arrayCollection);
        $this->assertSame('bar', $reflected->get('foo'));

        $reflected->reflectionEnd();
        $this->assertSame('bar', $reflected->getFoo());
    }
}
