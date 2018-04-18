<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Common\Traits;

use Psr\Log\LoggerInterface;
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
