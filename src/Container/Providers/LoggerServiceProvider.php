<?php

namespace Amber\Framework\Container\Providers;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class LoggerServiceProvider extends ServiceProvider
{
    public function setUp(): void
    {
        $container = static::getContainer();

        $container->register(Logger::class, LoggerInterface::class)
        ->setArgument('name', 'AmberFramework')
        ->afterConstruct('pushHandler', function () {
            switch (config('logger')->driver) {
                case 'simple':
                    return new StreamHandler(config('logger')->path);
                    break;

                case 'daily':
                    return new RotatingFileHandler(config('logger')->path, config('logger')->maxFiles);
                    break;
                
                default:
                    return new StreamHandler(config('logger')->path);
                    break;
            }
        });
    }
}
