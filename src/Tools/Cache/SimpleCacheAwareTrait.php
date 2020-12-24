<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tools\Cache;

use Symfony\Contracts\Cache\CacheInterface;

trait SimpleCacheAwareTrait
{
    protected $simpleCache;

    public function setSimpleCache($simpleCache): bool
    {
        $this->simpleCache = $simpleCache;

        return true;
    }

    public function getSimpleCache(): ?CacheInterface
    {
        return $this->simpleCache;
    }

    public function hasSimpleCache(): bool
    {
        return $this->simpleCache instanceof CacheInterface;
    }

    public function initSimpleCache($cache = null)
    {
        if (empty($cache)) {
            return;
        }

        return $this->setSimpleCache($cache);
    }

    public function simpleCacheGenerateId(string | array $key, string | null $prefix = null): string
    {
        if (\is_array($key)) {
            $sha1 = sha1(serialize($key));
        } else {
            $sha1 = sha1($key);
        }

        return $prefix.$sha1;
    }
}
