<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <g@g1mr.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <http://www.g1mr.com/>.
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
