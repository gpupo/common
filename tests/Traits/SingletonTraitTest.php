<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Tests\Objects\HasSingleton;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class SingletonTraitTest extends TestCaseAbstract
{
    public function testHasSingletonInstanceAccess()
    {
        $object = HasSingleton::getInstance();
        $this->assertInstanceOf('\Gpupo\Common\Interfaces\OptionsInterface', $object);
    }
}
