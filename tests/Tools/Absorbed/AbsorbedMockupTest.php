<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Tools\Absorbed;

use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Absorbed\AbsorbedAware;

/**
 * @coversNothing
 */
class AbsorbedMockupTest extends TestCaseAbstract
{
    use AbsorbedAware;

    public function testWorkWithNonExistentProperty()
    {
        $this->assertFalse($this->accessAbsorbed()->getFoo(false));
        $this->assertFalse($this->accessAbsorbed()->getFoo()->getBar(false));
        $this->assertTrue($this->accessAbsorbed()->getFoo()->getBar(true));
        $this->assertSame('James', $this->accessAbsorbed()->getFoo()->getBar()->getKing('James'));
    }

    public function testHasAbsorbed()
    {
        $this->assertFalse($this->hasAbsorbed());
        $this->absorb(new \DateTime());
        $this->assertTrue($this->hasAbsorbed());
    }
}
