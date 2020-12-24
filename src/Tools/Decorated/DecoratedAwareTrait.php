<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Decorated;

trait DecoratedAwareTrait
{
    protected $decorated;

    public function setDecorated($object)
    {
        $this->decorated = $object;

        return true;
    }

    public function getDecorated()
    {
        return $this->decorated;
    }
}
