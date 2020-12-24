<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Absorbed;

use Gpupo\Common\Traits\PropertyAccessorsTrait;
use Gpupo\Common\Traits\SingletonTrait;

class AbsorbedMockup
{
    use PropertyAccessorsTrait;
    use SingletonTrait;

    protected function __accessorGetter($property, $defaultValue = null)
    {
        if (null === $defaultValue) {
            return $this;
        }

        return $defaultValue;
    }
}
