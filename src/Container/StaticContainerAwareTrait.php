<?php

namespace Amber\Framework\Container;

use Amber\Container\Container;

trait StaticContainerAwareTrait
{
    private static $container;

    public static function setContainer(Container $container): void
    {
        self::$container = $container;
    }

    public static function getContainer(): Container
    {
        return self::$container;
    }
}
