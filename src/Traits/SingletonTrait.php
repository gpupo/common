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
    protected static $instanceList = [];

    final public static function getInstance()
    {
        $calledClassName = get_called_class();

        if (!isset(self::$instanceList[$calledClassName])) {
            self::setInstance($calledClassName, new $calledClassName());
        }

        return self::$instanceList[$calledClassName];
    }

    final public static function setInstance($calledClassName, $object)
    {
        self::$instanceList[$calledClassName] = $object;
    }

    final public static function rebuildInstance($object)
    {
        self::setInstance(get_called_class(), $object);
    }
}
