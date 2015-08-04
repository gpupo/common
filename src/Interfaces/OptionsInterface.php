<?php

/*
 * This file is part of gpupo/common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Common\Interfaces;

use Gpupo\Common\Entity\Collection;

interface OptionsInterface
{
    public function getOptions();

    public function setOptions();

    public function receiveOptions(Collection $options);
}