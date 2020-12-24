<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Traits;

use Psr\Log\LoggerAwareTrait as CoreLoggerAwareTrait;

trait LoggerAwareTrait
{
    use CoreLoggerAwareTrait;

    public function getLogger()
    {
        return $this->logger;
    }

    public function initLogger($logger, $name = null)
    {
        if (empty($logger)) {
            return;
        }

        if (!empty($name)) {
            $logger = $logger->withName($name);
        }

        return $this->setLogger($logger);
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->getLogger()) {
            return $this->getLogger()->log($level, $message, $context);
        }
    }
}
