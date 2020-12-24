<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Tools;

use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\StringTool;

/**
 * @coversNothing
 */
class StringToolTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderCasesToConvert
     */
    public function testConverteCamelCaseParaSnakeCase(string $camelCase, string $snakeCase): void
    {
        $this->assertSame($snakeCase, StringTool::camelCaseToSnakeCase($camelCase));
    }

    /**
     * @dataProvider dataProviderStringSlug
     */
    public function testSlugify(string $string, string $expected): void
    {
        $this->assertSame($expected, StringTool::slugify($string));
    }

    public function dataProviderStringSlug(): array
    {
        return [
            [
                'Foo Bar Zeta Jones',
                'foo-bar-zeta-jones',
            ],
            [
                'JOão ? da Sil@',
                'joao-da-sil',
            ],
        ];
    }

    public function dataProviderCasesToConvert(): array
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
