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

namespace Gpupo\Tests\Common\Tools;

use Gpupo\Common\Tools\StringTool;
use Gpupo\Tests\Common\TestCaseAbstract;

class StringToolTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderCases
     */
    public function testConverteCamelCaseParaSnakeCase($camelCase, $snakeCase)
    {
        $this->assertEquals($snakeCase, StringTool::camelCaseToSnakeCase($camelCase));
    }

    public function dataProviderCases()
    {
        return [
            ['FooBar', 'foo_bar'],
            ['fooBar', 'foo_bar'],
            ['foo_Bar', 'foo_bar'],
            ['ze_ta', 'ze_ta'],
            ['ZeTa', 'ze_ta'],
            ['zeTa', 'ze_ta'],
            ['FooBarZetaJones', 'foo_bar_zeta_jones'],
        ];
    }
}
