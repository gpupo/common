<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <g@g1mr.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * For more information, see <http://www.g1mr.com/>.
 */

namespace Gpupo\Tests\Common\Objects;

use Gpupo\Common\Traits\SingletonTrait;

class HasSingleton extends HasOptions
{
    use SingletonTrait;
}
