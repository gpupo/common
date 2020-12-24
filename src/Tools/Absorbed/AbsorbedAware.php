<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Absorbed;

trait AbsorbedAware
{
    private $__absorbed;

    public function absorb($result)
    {
        $this->__absorbed = $result;
    }

    public function hasAbsorbed()
    {
        return !empty($this->__absorbed);
    }

    public function accessAbsorbed()
    {
        if (false === $this->hasAbsorbed()) {
            $this->absorb($this->factoryEmptyAbsorbed());
        }

        return $this->__absorbed;
    }

    protected function factoryEmptyAbsorbed()
    {
        return AbsorbedMockup::getInstance();
    }
}
