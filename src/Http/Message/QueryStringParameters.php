<?php

namespace Amber\Framework\Http\Message;

use Amber\Utils\Implementations\AbstractWrapper;
use Amber\Collection\Collection;
use Amber\Framework\Container\Application;
use Symfony\Component\HttpFoundation\Request;

class QueryStringParameters extends AbstractWrapper
{
    /**
     * @var string The class accessor.
     */
    protected static $accessor = Collection::class;

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
        'has',
        'hasMultiple',
        'get',
        'getMultiple',
        'all',
        'exchangeArray',
    ];

    /**
     * Runs after the class constructor.
     *
     * @return void
     */
    public static function afterConstruct(): void
    {
        $request = Application::get(Request::class);

        static::exchangeArray($request->query->all());
    }
}
