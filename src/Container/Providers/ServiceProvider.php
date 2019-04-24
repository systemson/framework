<?php

namespace Amber\Framework\Container\Providers;

use Amber\Framework\Container\StaticContainerAwareTrait;
use Amber\Framework\Container\ContainerAwareClass;

class ServiceProvider extends ContainerAwareClass
{
    public static function boot(): void
    {
        //
    }

    public function setUp(): void
    {
        //
    }

    public function binds(): array
    {
        return [];
    }

    public function setDown(): void
    {
        //
    }
}
