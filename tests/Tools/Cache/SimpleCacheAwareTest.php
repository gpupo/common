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

namespace Gpupo\Common\Tests\Tools\Decorated;

use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Cache\SimpleCacheAwareTrait;
use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * @coversNothing
 */
class SimpleCacheAwareTest extends TestCaseAbstract
{
    use SimpleCacheAwareTrait;

    public function testHaveAInstance()
    {
        $cache = new FilesystemCache();
        $this->initSimpleCache($cache);
        $this->assertInstanceOf(FilesystemCache::class, $this->getSimpleCache());

        return $this->getSimpleCache();
    }

    /**
     * @depends testHaveAInstance
     */
    public function testOperations(FilesystemCache $cache)
    {
        $this->initSimpleCache($cache);

        // save a new item in the cache
        $this->assertTrue($this->getSimpleCache()->set('stats.products_count', 4711));

        // remove the cache key
        $this->getSimpleCache()->delete('stats.products_count');
        $this->assertFalse($this->getSimpleCache()->has('stats.products_count'));

        // or set it with a custom ttl
        $this->assertTrue($this->getSimpleCache()->set('stats.products_count', 4711, 3600));

        $this->assertFalse($this->getSimpleCache()->has('stats.products_not_exist'));

        // retrieve the value stored by the item
        $this->assertSame(4711, $this->getSimpleCache()->get('stats.products_count'));

        // or specify a default value, if the key doesn't exist
        $this->assertSame('foo', $this->getSimpleCache()->get('stats.products_not_exist', 'foo'));

        // clear *all* cache keys
        $this->getSimpleCache()->clear();

        $this->assertFalse($this->getSimpleCache()->has('stats.products_count'));
    }

    /**
     * @depends testHaveAInstance
     */
    public function testHasSimpleCache(FilesystemCache $cache)
    {
        $this->assertFalse($this->hasSimpleCache());
        $this->initSimpleCache($cache);
        $this->assertTrue($this->hasSimpleCache());
    }

    /**
     * @depends testHaveAInstance
     */
    public function testSimpleCacheGenerateId(FilesystemCache $cache)
    {
        $this->initSimpleCache($cache);
        $this->assertSame('0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33', $this->simpleCacheGenerateId('foo'));
        $this->assertSame('cfd403945388a36240193983e2a0fb6b8f7e7d92', $this->simpleCacheGenerateId(['foo', ['bar']]));
        $this->assertSame('foo-0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33', $this->simpleCacheGenerateId('foo', 'foo-'));
        $this->assertSame('bar-cfd403945388a36240193983e2a0fb6b8f7e7d92', $this->simpleCacheGenerateId(['foo', ['bar']], 'bar-'));
    }
}
