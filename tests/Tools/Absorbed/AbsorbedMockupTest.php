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

namespace Gpupo\Tests\Tools\Absorbed;

use Gpupo\Common\Tools\Absorbed\AbsorbedAware;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversNothing
 */
class AbsorbedMockupTest extends TestCaseAbstract
{
    use AbsorbedAware;

    public function testWorkWithNonExistentProperty()
    {
        $this->assertFalse($this->getAbsorbed()->getFoo(false));
        $this->assertFalse($this->getAbsorbed()->getFoo()->getBar(false));
        $this->assertTrue($this->getAbsorbed()->getFoo()->getBar(true));
        $this->assertSame('James', $this->getAbsorbed()->getFoo()->getBar()->getKing('James'));
    }
}
