<?php

namespace Amber\Framework\Container\Providers;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Adapter\Local;

class FilesystemServiceProvider extends ServiceProvider
{
    public function setUp(): void
    {
        $container = static::getContainer();

        $container->register(Filesystem::class, FilesystemInterface::class)
            ->setArgument(
                AdapterInterface::class,
                function () {
                    return new Local(config('filesystem')->main['path']);
                }
            );
    }
}
