<?php

/*
 * This file is part of common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Common\Traits;

trait SingletonTrait
{
    protected static $instance;

    /**
     * Permite acesso a instancia dinamica.
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $class = get_called_class();
            self::$instance = new $class();
        }

        return self::$instance;
    }
}
