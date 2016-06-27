<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <g@g1mr.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * For more information, see <http://www.g1mr.com/>.
 */

namespace Gpupo\Tests\Common\Traits;

use Gpupo\Tests\Common\Objects\HasOptions;
use Gpupo\Tests\Common\TestCaseAbstract;

class OptionsTraitTest extends TestCaseAbstract
{
    public function testImplementsOptionsInterface()
    {
        $object = new HasOptions();

        $this->assertInstanceOf('\Gpupo\Common\Interfaces\OptionsInterface', $object);
    }

    public function testHasOptionsContainer()
    {
        $object = new HasOptions();
        $object->setOptions(['foo' => 'bar']);
        $this->assertSame('bar', $object->getOptions()->get('foo'));
    }
}
