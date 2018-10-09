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

use DateTime;

class DatetimeRange
{
    protected $start;

    protected $end;

    public function setStart(DateTime $start): void
    {
        $this->start = $start;
    }

    public function setEnd(DateTime $end): void
    {
        $this->end = $end;
    }

    public function getEnd():? DateTime
    {
        return $this->end;
    }

    public function getStart():? DateTime
    {
        return $this->start;
    }

    public function fullDaysTimestamp()
    {
        return [
            'start' => $this->getStart()->format('Y-m-d 00:00:00'),
            'end' => $this->getEnd()->format('Y-m-d 23:59:59'),
        ];
    }
}
