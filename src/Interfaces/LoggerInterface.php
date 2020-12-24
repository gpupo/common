<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Interfaces;

interface LoggerInterface
{
    public function getLogger();

    public function initLogger($logger);

    public function log($level, $message, array $context = []);
}
