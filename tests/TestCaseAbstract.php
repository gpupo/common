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

namespace Gpupo\Tests\Common;

abstract class TestCaseAbstract extends \PHPUnit_Framework_TestCase
{
    protected function getConstant($name, $default = false)
    {
        if (defined($name)) {
            return constant($name);
        }

        return $default;
    }

    protected function hasConstant($name)
    {
        $value = $this->getConstant($name);

        return empty($value) ? false : true;
    }
}
