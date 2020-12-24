<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Datetime;

use DateInterval;
use DateTime;

class TimeShift
{
    public function back(DateTime $datetime, $string): DateTime
    {
        $base_day = $this->stripDay($datetime);
        $base_month = $this->stripMonth($datetime);
        $base_last_day_of_month = $this->getLastDayOfMounth($datetime);

        $dt = clone $datetime;
        $dt->sub(new DateInterval($string));
        if ($base_month === $this->stripMonth($dt)) {
            $this->moveToLastDayOfLastMonth($dt);
        } elseif ($base_day === $base_last_day_of_month) {
            $this->moveToLastDayOfCurrentMonth($dt);
        }

        return $dt;
    }

    public function forward(DateTime $datetime, $string): DateTime
    {
        $base_day = $this->stripDay($datetime);
        $dt = clone $datetime;
        $dt->add(new DateInterval($string));

        if (10 < ($base_day - $this->stripDay($dt))) {
            $this->moveToLastDayOfLastMonth($dt);
        } elseif ($base_day !== $this->stripDay($dt)) {
            $this->moveToLastDayOfCurrentMonth($dt);
        }

        return $dt;
    }

    protected function stripMonth(DateTime $datetime): int
    {
        return (int) $datetime->format('n');
    }

    protected function stripDay(DateTime $datetime): int
    {
        return (int) $datetime->format('j');
    }

    protected function moveToLastDayOfCurrentMonth(DateTime $datetime): void
    {
        $datetime->modify('last day of this month');
    }

    protected function getLastDayOfMounth(DateTime $datetime): int
    {
        $current = clone $datetime;
        $this->moveToLastDayOfCurrentMonth($current);

        return $this->stripDay($current);
    }

    protected function moveToLastDayOfLastMonth(DateTime $datetime): void
    {
        $datetime->sub(new DateInterval('P5D'));
        $this->moveToLastDayOfCurrentMonth($datetime);
    }
}
