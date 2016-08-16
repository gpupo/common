<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <g@g1mr.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <http://www.g1mr.com/>.
 */

namespace Gpupo\Common\Tools\Datetime;

use DateTime;

class Holidays
{
    protected $datetime;

    public function __construct(Datetime $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return array
     */
    public function listOfHolidays()
    {
        $y = $this->datetime->format('Y');
        $d = 86400;
        $easter = easter_date($y);

        return [
            'brazil'   => [
                date('d-m-Y', $easter),               // Pascoa
                date('d-m-Y', $easter + (60 * $d)), // Corpus christi
                date('d-m-Y', $easter - (48 * $d)), // Segunda de carnaval
                date('d-m-Y', $easter - (47 * $d)), // Terca de carnaval
                date('d-m-Y', $easter - (46 * $d)), // Quarta feira de cinzas
                date('d-m-Y', $easter - (2 * $d)),  // Sexta feira santa
                '01-01-'.$y,                        // Dia mundial da paz
                '21-04-'.$y,                        // Tiradentes
                '01-05-'.$y,                        // Dia do trabalhador
                '07-09-'.$y,                        // Dia da independencia
                '12-10-'.$y,                        // Nossa senhora da aparecida
                '02-11-'.$y,                        // Dia de finados
                '15-11-'.$y,                        // Proclamacao da republica
                '24-12-'.$y,                        // Natal
                '25-12-'.$y,                        // Natal
                '31-12-'.$y,                        // Reveillon
            ],
        ];
    }

    public function isHoliday($country)
    {
        $list = (array) $this->listOfHolidays()[strtolower($country)];

        return in_array($this->datetime->format('d-m-Y'), $list, true);
    }

}
