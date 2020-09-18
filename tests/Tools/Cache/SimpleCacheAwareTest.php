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

namespace Gpupo\Common\Tests\Tools\Cache;

use Gpupo\Common\Tests\TestCaseAbstract;
use Gpupo\Common\Tools\Cache\SimpleCacheAwareTrait;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * @coversNothing
 */
class SimpleCacheAwareTest extends TestCaseAbstract
{
    use SimpleCacheAwareTrait;

    public function testHaveAInstance()
    {
        $cache = new FilesystemAdapter();
        $this->initSimpleCache($cache);
        $this->assertInstanceOf(FilesystemAdapter::class, $this->getSimpleCache());

        return $this->getSimpleCache();
    }

    /**
     * @depends testHaveAInstance
     */
    public function testOperations(FilesystemAdapter $cache)
    {
        $this->initSimpleCache($cache);
        $adapter = $this->getSimpleCache();

        $item = $adapter->getItem('stats.products_count');
        $this->assertInstanceOf(ItemInterface::class, $item);
        // save a new item in FilesystemCachethe cache
        $item->set(4711);
        $adapter->save($item);

        // remove the cache key
        $adapter->deleteItem('stats.products_count');
        $item = $adapter->getItem('stats.products_count');
        $this->assertFalse($item->isHit());

        // or set it with a custom ttl
        $item->expiresAfter(3600);
        $item->set(4711);
        $adapter->save($item);

        $item = $adapter->getItem('stats.products_inexistent');
        $this->assertFalse($item->isHit());

        // retrieve the value stored by the item
        $item = $adapter->getItem('stats.products_count');
        $this->assertTrue($item->isHit());
        $this->assertSame(4711, $item->get());

        // or specify a default value, if the key doesn't exist
        $this->assertSame('foo', $adapter->get('stats.products_not_exist', function (ItemInterface $item) {
            return 'foo';
        }));

        // clear *all* cache keys
        $adapter->clear();
        $this->assertFalse($adapter->hasItem('stats.products_count'));
    }

    /**
     * @depends testHaveAInstance
     */
    public function testHasSimpleCache(FilesystemAdapter $cache)
    {
        $this->assertFalse($this->hasSimpleCache());
        $this->initSimpleCache($cache);
        $this->assertTrue($this->hasSimpleCache());
    }

    /**
     * @depends testHaveAInstance
     */
    public function testSimpleCacheGenerateId(FilesystemAdapter $cache)
    {
        $this->initSimpleCache($cache);
        $this->assertSame('0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33', $this->simpleCacheGenerateId('foo'));
        $this->assertSame('cfd403945388a36240193983e2a0fb6b8f7e7d92', $this->simpleCacheGenerateId(['foo', ['bar']]));
        $this->assertSame('foo-0beec7b5ea3f0fdbc95d0dd47f3c5bc275da8a33', $this->simpleCacheGenerateId('foo', 'foo-'));
        $this->assertSame('bar-cfd403945388a36240193983e2a0fb6b8f7e7d92', $this->simpleCacheGenerateId(['foo', ['bar']], 'bar-'));
    }
}
