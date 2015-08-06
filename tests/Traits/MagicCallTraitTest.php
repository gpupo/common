<?php

/*
 * This file is part of gpupo/common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For more information, see
 * <http://www.g1mr.com/common/>.
 */

namespace Gpupo\Tests\Common\Traits;

use Gpupo\Tests\Common\Objects\HasMagicCall;
use Gpupo\Tests\Common\TestCaseAbstract;

class MagicCallTraitTest extends TestCaseAbstract
{
    public function testHasMagicMethods()
    {
        $object = new HasMagicCall(['foo' => 'bar']);
        $this->assertEquals('bar', $object->getFoo());
    }
}
