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
use Gpupo\Common\Tools\Datetime\Holidays;
use Gpupo\Common\Tests\TestCaseAbstract;

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
            '21-04-2017' => true,
            '22-04-2017' => false,
            '02-11-2017' => true,
            '16-04-2017' => true, //Pascoa 2019
            '01-04-2018' => true, //Pascoa 2019
            '21-04-2019' => true, //Pascoa 2019
            '12-04-2020' => true, //Pascoa 2020
            '20-04-2025' => true, //Pascoa 2025
        ];

        foreach ($l as $d => $b) {
            $datetime = new DateTime($d);
            $a[] = [new Holidays($datetime), $d, $b];
        }

        return $a;
    }

    /**
     * @testdox ``getHolidays()``
     * @cover ::getHolidays
     * @dataProvider dataProviderHolidays
     */
    public function testListOfHolidays(Holidays $holidays)
    {
        $holidays = $holidays->getHolidays();
        $this->assertInternalType('array', $holidays);
        $this->assertInternalType('array', $holidays['brazil']);
    }

    /**
     * @testdox ``isHoliday()``
     * @cover ::isHoliday
     * @dataProvider dataProviderHolidays
     *
     * @param mixed $d
     * @param mixed $b
     */
    public function testIsHoliday(Holidays $holidays, $d, $b)
    {
        $this->assertSame($b, $holidays->isHoliday('Brazil'), sprintf('year %s day %s', $holidays->getYear(), $d));
    }
}
