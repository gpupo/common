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

namespace Gpupo\Tests\Tools\Datetime;

use Gpupo\Common\Tools\Datetime\Normalizer;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversDefaultClass \Gpupo\Common\Tools\Datetime\Normalizer
 */
class NormalizerTest extends TestCaseAbstract
{
    public function manyFormatsDataProvider()
    {
        return [
            ['2016-06-24 15:45:13', '2016-06-24 15:45:13'],
            ['2016/06/24 15:45:13', '2016-06-24 15:45:13'],
            ['24-06-2016', '2016-06-24 00:00:00'],
            ['2016/06/24', '2016-06-24 00:00:00'],
            ['2016-06-24T15:01:38.826Z', '2016-06-24 15:01:38'],
            ['1466791298000', '2016-06-24 18:01:38'],
        ];
    }

    /**
     * @dataProvider manyFormatsDataProvider
     *
     * @param mixed $string
     * @param mixed $expected
     */
    public function testConvertToDateFormat($string, $expected)
    {
        $normalizer = new Normalizer();
        $datetime = $normalizer->setFlagRemoveTimezone(true)->normalizeFormat($string);
        $this->assertSame($expected, $datetime, sprintf('Input string=%s', $string));
    }
}
