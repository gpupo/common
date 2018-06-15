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

namespace Gpupo\Tests\Common\Traits;

use Gpupo\Tests\Common\Objects\HasPropertyAccessors;
use Gpupo\Tests\Common\TestCaseAbstract;

/**
 * @coversNothing
 */
class PropertyAcessorsTraitTest extends TestCaseAbstract
{
    public function testHasMagicMethods()
    {
        $object = new HasPropertyAccessors();
        $this->assertSame('bar', $object->getFoo());
    }
}