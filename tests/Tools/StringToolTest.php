<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Common\Tests\Tools;

use Gpupo\Common\Tools\StringTool;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class StringToolTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderCases
     *
     * @param mixed $camelCase
     * @param mixed $snakeCase
     */
    public function testConverteCamelCaseParaSnakeCase($camelCase, $snakeCase)
    {
        $this->assertSame($snakeCase, StringTool::camelCaseToSnakeCase($camelCase));
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
