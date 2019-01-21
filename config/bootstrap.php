<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common-sdk
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * For more information, see <https://opensource.gpupo.com/>.
 */

use Symfony\Component\Dotenv\Dotenv;

if (!class_exists('\Gpupo\Common\Console\Application')) {
    require __DIR__ . '/../vendor/autoload.php';
}

if (!class_exists(Dotenv::class)) {
    throw new RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    // load all the .env files
    (new Dotenv())->loadEnv(dirname(__DIR__).'/.env');
}
