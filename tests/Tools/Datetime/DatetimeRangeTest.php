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
use Gpupo\Common\Tools\Datetime\DatetimeRange;

/**
 * @coversDefaultClass \Gpupo\Common\Tools\Datetime\DatetimeRange
 */
class DatetimeRangeTest extends TestCaseAbstract
{
    public function testBackLastMonth()
    {
        $p1 = new DatetimeRange();
        $p1->setStart(new DateTime('first day of last month'));
        $p1->setEnd(new DateTime('last day of last month'));
        $p2 = clone $p1;
        $p2->back('P1M');

        $this->assertNotSame($p1->fullDaysTimestamp(), $p2->fullDaysTimestamp());
    }

    /**
     * @dataProvider dataProviderBack
     *
     * @param mixed $start
     * @param mixed $end
     * @param mixed $op
     * @param mixed $back
     * @param mixed $expected
     */
    public function testBackMonth($start, $end, $op, $back, $expected)
    {
        $d = new DatetimeRange();
        $d->setStart(new DateTime($start));
        $d->setEnd(new DateTime($end));
        $d->{$op}($back);

        $this->assertSame($expected, $d->fullDaysTimestamp());
    }

    public function dataProviderBack()
    {
        return [
            ['2018-10-01', '2018-10-31', 'back', 'P1M', ['start' => '2018-09-01 00:00:00', 'end' => '2018-09-30 23:59:59']],
            ['2018-10-01', '2018-10-31', 'back', 'P2M', ['start' => '2018-08-01 00:00:00', 'end' => '2018-08-31 23:59:59']],
            ['2018-01-01', '2018-01-31', 'forward', 'P1M', ['start' => '2018-02-01 00:00:00', 'end' => '2018-02-28 23:59:59']],
            ['2018-01-01', '2018-01-31', 'forward', 'P2M', ['start' => '2018-03-01 00:00:00', 'end' => '2018-03-31 23:59:59']],
            ['2018-10-07', '2018-10-14', 'back', 'P1M', ['start' => '2018-09-07 00:00:00', 'end' => '2018-09-14 23:59:59']],
            ['2018-10-15', '2018-10-31', 'back', 'P1M', ['start' => '2018-09-15 00:00:00', 'end' => '2018-09-30 23:59:59']],
            ['2018-01-15', '2018-01-31', 'forward', 'P1M', ['start' => '2018-02-15 00:00:00', 'end' => '2018-02-28 23:59:59']],
            ['2018-01-15', '2018-02-15', 'forward', 'P1M', ['start' => '2018-02-15 00:00:00', 'end' => '2018-03-15 23:59:59']],
            ['2018-01-15', '2018-02-15', 'forward', 'P2M', ['start' => '2018-03-15 00:00:00', 'end' => '2018-04-15 23:59:59']],
        ];
    }
}
