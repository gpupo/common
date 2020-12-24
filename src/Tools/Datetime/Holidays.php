<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Datetime;

use DateTime;

class Holidays
{
    const SECONDS_IN_A_DAY = 86400;

    protected $datetime;

    public function __construct(Datetime $datetime)
    {
        $this->datetime = $datetime;
    }

    public function getYear(): int
    {
        return (int) ($this->datetime->format('Y'));
    }

    public function getEasterDate(): int
    {
        $value = easter_date($this->getYear());
        $value += self::SECONDS_IN_A_DAY / 4;

        return $value;
    }

    public function getHolidays(): array
    {
        $year = $this->getYear();
        $easter = $this->getEasterDate();

        $easter_based = function ($value) use ($easter) {
            $days = $value * self::SECONDS_IN_A_DAY;

            return date('d-m-Y', $easter + $days);
        };

        return [
            'brazil' => [
                'Pascoa' => $easter_based(0),
                'Corpus Christi' => $easter_based(60),
                'Segunda-feira de carnaval' => $easter_based(-48),
                'Terça-feira de carnaval' => $easter_based(-47),
                'Quarta-feira de cinzas' => $easter_based(-46),
                'Sexta feira Santa' => $easter_based(-2),
                'Dia mundial da paz' => '01-01-'.$year,
                'Tiradentes' => '21-04-'.$year,
                'Dia do trabalhador' => '01-05-'.$year,
                'Dia da independencia' => '07-09-'.$year,
                'Nossa senhora da aparecida' => '12-10-'.$year,
                'Dia de finados' => '02-11-'.$year,
                'Proclamacao da republica' => '15-11-'.$year,
                'Véspera de Natal' => '24-12-'.$year,
                'Natal' => '25-12-'.$year,
                'Reveillon' => '31-12-'.$year,
            ],
        ];
    }

    public function isHoliday($country): bool
    {
        $array = $this->getHolidays();
        $key = mb_strtolower($country);
        if (!\array_key_exists($key, $array) || !\is_array($array[$key])) {
            return false;
        }

        return \in_array($this->datetime->format('d-m-Y'), $array[$key], true);
    }
}
