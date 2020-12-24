<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Datetime;

use DateTime;

class DatetimeRange
{
    protected $start;

    protected $end;

    public function __clone()
    {
        $this->start = clone $this->start;
        $this->end = clone $this->end;
    }

    public function setStart(DateTime $start): void
    {
        $this->start = $start;
    }

    public function setEnd(DateTime $end): void
    {
        $this->end = $end;
    }

    public function getEnd(): ?DateTime
    {
        return $this->end;
    }

    public function getStart(): ?DateTime
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

    public function back($string): void
    {
        $ts = new TimeShift();
        $this->setStart($ts->back($this->getStart(), $string));
        $this->setEnd($ts->back($this->getEnd(), $string));
    }

    public function forward($string): void
    {
        $ts = new TimeShift();
        $this->setStart($ts->forward($this->getStart(), $string));
        $this->setEnd($ts->forward($this->getEnd(), $string));
    }
}
