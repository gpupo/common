<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Entity\Collection;
use Gpupo\Common\Tests\Objects\HasPrevious;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class PreviousAwareTraitTest extends TestCaseAbstract
{
    public function testImplementsLoggerInterface()
    {
        $object = new HasPrevious();
        $foo = new Collection(['foo' => 'bar']);
        $object->setPrevious($foo);
        $this->assertSame('bar', $object->getPrevious()->get('foo'));
    }
}
