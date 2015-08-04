<?php

/*
 * This file is part of gpupo/common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Tests\Common\Traits;

use Gpupo\Tests\Common\Objects\HasOptions;
use Gpupo\Tests\Common\TestCaseAbstract;

class OptionsTraitTest extends TestCaseAbstract
{
    public function testHasOptions()
    {
        $object = new HasOptions();

        $this->assertInstanceOf('\Gpupo\Common\Interfaces\OptionsInterface', $object);
    }
}
