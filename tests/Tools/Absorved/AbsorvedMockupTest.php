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

namespace Gpupo\Tests\Tools\Absorved;

use Gpupo\Common\Tools\Absorved\AbsorvedAware;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversNothing
 */
class AbsorvedMockupTest extends TestCaseAbstract
{
    use AbsorvedAware;

    public function testWorkWithNonExistentProperty()
    {
        $this->assertFalse($this->getAbsorved()->getFoo(false));
        $this->assertFalse($this->getAbsorved()->getFoo()->getBar(false));
        $this->assertTrue($this->getAbsorved()->getFoo()->getBar(true));
        $this->assertSame('James', $this->getAbsorved()->getFoo()->getBar()->getKing('James'));
    }
}
