<?php

namespace Amber\Framework\Container\Providers;

use Amber\Cache\Cache;
use Amber\Cache\Driver\SimpleCache;
use Psr\SimpleCache\CacheInterface;

class CacheServiceProvider extends ServiceProvider
{
    public function setUp(): void
    {
        $container = static::getContainer();

        $container->register(Cache::class, CacheInterface::class)
            ->afterConstruct(
                'pushHandler',
                function () {
                    return new SimpleCache(config('cache')->path);
                }
            )
        ->singleton();
    }
}
