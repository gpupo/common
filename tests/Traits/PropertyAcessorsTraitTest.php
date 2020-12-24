<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Tests\Objects\HasPropertyAccessors;
use Gpupo\Common\Tests\TestCaseAbstract;

/**
 * @coversNothing
 */
class PropertyAcessorsTraitTest extends TestCaseAbstract
{
    public function testHasMagicMethods()
    {
        $object = new HasPropertyAccessors();
        $this->assertSame('bar', $object->foo);
        $this->assertSame('bar', $object->getFoo());
        $this->assertSame(3, $object->getLittleBigPlanet());
        $this->assertSame(3, $object->little_big_planet);
        $this->assertSame(3, $object->littleBigPlanet);
        $object->foo = $object->littleBigPlanet = 'hi';
        $this->assertSame('hi', $object->foo);
        $this->assertSame('hi', $object->getLittleBigPlanet());
        $this->assertSame('hi', $object->little_big_planet);
        $this->assertSame('hi', $object->littleBigPlanet);

        return $object;
    }

    /**
     * @depends testHasMagicMethods
     *
     * @param mixed $object
     */
    public function testAccessGetMethods($object)
    {
        $this->assertSame('floyd', $object->pink);
        $this->assertSame('floyd', $object->getPink());

        $object->pink = 'blue';
        $this->assertSame('blue', $object->pink);
    }
}
