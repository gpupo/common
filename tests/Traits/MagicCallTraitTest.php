<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://www.gpupo.com/>.
 */

namespace Gpupo\Tests\Common\Traits;

use Gpupo\Tests\Common\Objects\HasMagicCall;
use Gpupo\Tests\Common\TestCaseAbstract;

class MagicCallTraitTest extends TestCaseAbstract
{
    public function testHasMagicMethods()
    {
        $object = new HasMagicCall(['foo' => 'bar']);
        $this->assertSame('bar', $object->getFoo());
    }
}
