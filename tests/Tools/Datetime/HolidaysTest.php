<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://www.gpupo.com/>.
 */

namespace Tools\Datetime;

use DateTime;
use Gpupo\Common\Tools\Datetime\Holidays;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversDefaultClass \Gpupo\Common\Tools\Datetime\Holidays
 */
class HolidaysTest extends TestCaseAbstract
{
    /**
     * @return \Gpupo\Common\Tools\Datetime\Holidays
     */
    public function dataProviderHolidays()
    {
        $a = [];
        $l = [
            '01-01-2017' => true,
            '02-01-2017' => false,
            '25-12-2017' => true,
            '28-02-2017' => true,
            '14-04-2017' => true,
            '21-04-2017' => true,
            '22-04-2017' => false,
            '02-11-2017' => true,
        ];

        foreach ($l as $d => $b) {
            $datetime = new DateTime($d);
            $a[] = [new Holidays($datetime), $d, $b];
        }

        return $a;
    }

    /**
     * @testdox ``listOfHolidays()``
     * @cover ::listOfHolidays
     * @dataProvider dataProviderHolidays
     * @test
     */
    public function listOfHolidays(Holidays $holidays)
    {
        $this->assertInternalType('array', $holidays->listOfHolidays('Brazil'));
    }

    /**
     * @testdox ``isHoliday()``
     * @cover ::isHoliday
     * @dataProvider dataProviderHolidays
     * @test
     */
    public function isHoliday(Holidays $holidays, $d, $b)
    {
        $this->assertSame($b, $holidays->isHoliday('Brazil'), 'd:'.$d);
    }
}
