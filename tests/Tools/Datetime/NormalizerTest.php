<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Tools\Datetime;

use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Datetime\Normalizer;

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
            ['2016-12-09T09:47:39.000-04:00', '2016-12-09 09:47:39'],
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
