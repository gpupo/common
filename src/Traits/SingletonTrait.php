<?php

/*
 * This file is part of gpupo/common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For more information, see
 * <http://www.g1mr.com/common/>.
 */

namespace Gpupo\Common\Traits;

trait SingletonTrait
{
    final public static function getInstance()
    {
        static $instanceList = [];

        $calledClassName = get_called_class();

        if (!isset($instanceList[$calledClassName])) {
            $instanceList[$calledClassName] = new $calledClassName();
        }

        return $instanceList[$calledClassName];
    }
}
