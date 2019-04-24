<?php

namespace Amber\Framework\Container;

use Amber\Framework\Container\ContainerFacade;
use Amber\Container\Container;
use Symfony\Component\HttpFoundation\Request;

class Application extends ContainerFacade
{
    /**
     * @var string The class accessor.
     */
    protected static $accessor = Container::class;

    /**
     * @var mixed The instance of the accessor.
     */
    protected static $instance;

    /**
     * To expose publicy a method it should be declared protected.
     *
     * @var array The method(s) that should be publicly exposed.
     */
    protected static $passthru = [
        'bind',
        'get',
        'has',
        'unbind',
        'bindMultiple',
        'getMultiple',
        'hasMultiple',
        'unbindMultiple',
        'register',
        'make',
    ];

    private static $providers = [];

    /**
     * Runs after the class constructor.
     *
     * @return void
     */
    public static function beforeConstruct(): void
    {
        self::bootProviders();
    }

    /**
     * Runs after the class constructor.
     *
     * @return void
     */
    public static function afterConstruct(): void
    {
        // Bind from config file
        foreach (config('app')->binds as $service) {
            static::bind($service);
        }

        self::setUpProviders();
    }

    private static function bootProviders(): void
    {
        self::$providers = config('app')->providers;
        array_map(
            function ($value) {
                $value::boot();
            },
            self::$providers
        );
    }

    private static function setUpProviders(): void
    {
        array_map(
            function ($value) {
                static::make($value)->setUp();
            },
            self::$providers
        );
    }

    private static function setDownProviders(): void
    {
        array_map(
            function ($value) {
                static::make($value)->setDown();
            },
            self::$providers
        );
    }
}
