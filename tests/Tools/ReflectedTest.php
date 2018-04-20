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

namespace Gpupo\Tests\Common\Tools;

use DateTime;
use Gpupo\Common\Entity\Collection;
use Gpupo\Common\Tools\Datetime\Holidays;
use Gpupo\Common\Tools\Reflected;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversNothing
 */
class ReflectedTest extends TestCaseAbstract
{
    public function testAccessPrivateMethod()
    {
        $obj = new Collection([
            'foo' => 'bar',
            'king' => 'James',
        ]);

        $reflected = new Reflected($obj);

        $this->assertSame(['foo' => 'bar'], $reflected->partitionByArrayKey(['foo']));
    }

    public function testAccessPrivateProperty()
    {
        $datetime = new DateTime();
        $obj = new Holidays($datetime);

        $reflected = new Reflected($obj);

        $this->assertSame($datetime, $reflected->datetime);
    }
}
