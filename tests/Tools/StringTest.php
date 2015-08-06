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

use Gpupo\Common\Tools\String;
use Gpupo\Tests\Common\TestCaseAbstract;

class StringTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderCases
     */
    public function testConverteCamelCaseParaSnakeCase($camelCase, $snakeCase)
    {
        $this->assertEquals($snakeCase, String::camelCaseToSnakeCase($camelCase));
    }

    public function dataProviderCases()
    {
        return [
            ['FooBar', 'foo_bar'],
            ['fooBar', 'foo_bar'],
            ['foo_Bar', 'foo_bar'],
            ['FooBarZetaJones', 'foo_bar_zeta_jones'],
        ];
    }
}
