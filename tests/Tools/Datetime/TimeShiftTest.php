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

namespace Gpupo\Common\Tests\Tools\Datetime;

use DateTime;
use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Datetime\TimeShift;

/**
 * @coversDefaultClass \Gpupo\Common\Tools\Datetime\TimeShift
 */
class TimeShiftTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderDates
     *
     * @param mixed $date
     * @param mixed $op
     * @param mixed $time
     * @param mixed $expected
     */
    public function testShiftMonth($date, $op, $time, $expected)
    {
        $ts = new TimeShift();
        $s = $ts->{$op}(new Datetime($date), $time);

        $this->assertSame($expected, $s->format('Y-m-d'));
    }

    public function dataProviderDates()
    {
        return [
            ['2018-10-01', 'back', 'P1M', '2018-09-01'],
            ['2018-10-31', 'back', 'P1M', '2018-09-30'],
            ['2018-10-31', 'back', 'P2M', '2018-08-31'],
            ['2018-01-31', 'forward', 'P1M', '2018-02-28'],
        ];
    }
}
