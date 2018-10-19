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

namespace Gpupo\Common\Tools\Datetime;

use DateInterval;
use DateTime;

class TimeShift
{
    public function back(DateTime $datetime, $string): DateTime
    {
        $interval = new DateInterval($string);
        $j = $datetime->format('j');
        $datetime->sub($interval);

        if ($j !== $datetime->format('j')) {
            $datetime->modify('last day of last month');
        }

        return $datetime;
    }

    public function forward(DateTime $datetime, $string): DateTime
    {
        $interval = new DateInterval($string);
        $j = $datetime->format('j');
        $datetime->add($interval);

        if ($j !== $datetime->format('j')) {
            $datetime->modify('last day of last month');
        }

        return $datetime;
    }
}
