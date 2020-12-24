<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Datetime;

use DateTime;
use DateTimeZone;

class Normalizer
{
    protected $currentTimeZone = 'UTC';

    protected $flags = [
        'removeTimezone' => false,
    ];

    public function setCurrentTimeZone($string)
    {
        $this->currentTimeZone = $string;
    }

    public function getCurrentTimeZone()
    {
        return $this->currentTimeZone;
    }

    public function factoryDateTimeByString($string)
    {
        return new DateTime($string, $this->datetimeTimeZone());
    }

    public function setFlagRemoveTimezone(bool $flag)
    {
        $this->flags['removeTimezone'] = $flag;

        return $this;
    }

    public function getFlag($key): bool
    {
        return $this->flags[$key];
    }

    public function datetimeTimeZone()
    {
        return new DateTimeZone($this->getCurrentTimeZone());
    }

    public function normalizeFormat($string)
    {
        if (is_numeric($string)) {
            return $this->normalizeFormat($this->millisecondsConverter($string));
        }

        $datetime = $this->factoryDateTimeByString($string);

        if ($this->getFlag('removeTimezone')) {
            return $datetime->format('Y-m-d H:i:s');
        }

        return $datetime->format('c');
    }

    public function millisecondsConverter($string)
    {
        $df = date_default_timezone_get();
        if ($df !== $this->getCurrentTimeZone()) {
            date_default_timezone_set($this->getCurrentTimeZone());
        }
        $date = date('c', $string / 1000);

        if ($df !== $this->getCurrentTimeZone()) {
            date_default_timezone_set($df);
        }

        return $date;
    }

    public function normalizeTimeZone(DateTime $value)
    {
        if ($value instanceof DateTime) {
            $value->setTimeZone($this->datetimeTimeZone());
        }

        return $value;
    }
}
