<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Objects;

use Gpupo\Common\Traits\PropertyAccessorsTrait;

class HasPropertyAccessors
{
    use PropertyAccessorsTrait;

    protected $foo = 'bar';

    protected $littleBigPlanet = 3;

    protected $secret = 'floyd';

    public function getPink()
    {
        return $this->secret;
    }

    public function setPink($value)
    {
        $this->secret = $value;
    }
}
