<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Interfaces\LoggerInterface;
use Gpupo\Common\Tests\Objects\HasLogger;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class LoggerAwareTraitTest extends TestCaseAbstract
{
    public function testImplementsLoggerInterface()
    {
        $object = new HasLogger();

        $this->assertInstanceOf(LoggerInterface::class, $object);
    }
}
