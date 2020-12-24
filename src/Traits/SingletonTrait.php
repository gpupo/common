<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Traits;

trait SingletonTrait
{
    protected static $instanceList = [];

    /**
     * trigger.
     */
    public function onInstanceContruction()
    {
    }

    final public static function getInstance()
    {
        $calledClassName = static::class;

        if (!isset(self::$instanceList[$calledClassName])) {
            self::setInstance($calledClassName, new $calledClassName());
        }

        return self::$instanceList[$calledClassName];
    }

    final public static function setInstance($calledClassName, $object)
    {
        self::$instanceList[$calledClassName] = $object;
        $object->onInstanceContruction();
    }

    final public static function rebuildInstance($object)
    {
        self::setInstance(static::class, $object);
    }
}
