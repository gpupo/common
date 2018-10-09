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

use DateTime;
use Gpupo\Common\Tools\Datetime\DatetimeRange;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversDefaultClass \Gpupo\Common\Tools\Datetime\DatetimeRange
 */
class DatetimeRangeTest extends TestCaseAbstract
{
    public function testBack()
    {
        $p1 = new DatetimeRange();
        $p1->setStart(new DateTime('first day of last month'));
        $p1->setEnd(new DateTime('last day of last month'));

        $p2 = clone $p1;
        $p2->back('P1M');

        $this->assertNotSame($p1->fullDaysTimestamp(), $p2->fullDaysTimestamp());
    }
}
