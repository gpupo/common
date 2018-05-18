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

namespace Gpupo\Common\Tools\Cache;

use Psr\SimpleCache\CacheInterface;

trait SimpleCacheAwareTrait
{
    protected $simpleCache;

    public function setSimpleCache(CacheInterface $simpleCache)
    {
        $this->simpleCache = $simpleCache;

        return true;
    }

    public function getSimpleCache(): ?CacheInterface
    {
        return $this->simpleCache;
    }

    public function initSimpleCache($cache = null)
    {
        if (empty($cache)) {
            return;
        }

        return $this->setSimpleCache($cache);
    }
}
