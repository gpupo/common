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

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Interfaces\OptionsInterface;
use Gpupo\Common\Tests\Objects\HasOptions;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class OptionsTraitTest extends TestCaseAbstract
{
    public function testImplementsOptionsInterface()
    {
        $object = new HasOptions();

        $this->assertInstanceOf(OptionsInterface::class, $object);
    }

    public function testHasOptionsContainer()
    {
        $object = new HasOptions();
        $object->setOptions(['foo' => 'bar']);
        $this->assertSame('bar', $object->getOptions()->get('foo'));
    }

    public function testMergeTwoOptions()
    {
        $objectA = new HasOptions();
        $objectA->setOptions(['foo' => 'bar']);

        $objectB = new HasOptions();
        $objectB->receiveOptions($objectA->getOptions());

        $this->assertSame('bar', $objectB->getOptions()->get('foo'));
        $this->assertSame('margaret', $objectB->getOptions()->get('queen'));

        $objectA->setOptions([
            'foo' => 'bar',
            'king' => 'bob',
        ]);
        $this->assertSame('bob', $objectA->getOptions()->get('king'));
        $this->assertSame('james', $objectB->getOptions()->get('king'));
        $objectB->receiveOptions($objectA->getOptions());
        $this->assertSame('bob', $objectB->getOptions()->get('king'));
    }
}
