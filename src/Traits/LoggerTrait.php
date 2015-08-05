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

trait LoggerTrait
{
    use \Psr\Log\LoggerTrait;
    use \Psr\Log\LoggerAwareTrait;

    public function getLogger()
    {
        return $this->logger;
    }

    public function initLogger($logger)
    {
        if (!empty($logger)) {
            return $this->setLogger($logger);
        }
    }
    public function log($level, $message, array $context = array())
    {
        if ($this->getLogger()) {
            return $this->getLogger()->log($level, $message, $context);
        }
    }
}
