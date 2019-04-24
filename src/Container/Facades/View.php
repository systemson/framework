<?php

namespace Amber\Framework\Container\Facades;

use Amber\Framework\Application;
use Amber\Sketch\Sketch;
use Amber\Sketch\Template\Template;
use Amber\Framework\Container\ContainerFacade;

class View extends ContainerFacade
{
    /**
     * @var string The class accessor.
     */
    protected static $accessor = Sketch::class;

    /**
     * @var mixed The instance of the accessor.
     */
    protected static $instance;

    /**
     * To expose publicy a method it should be declared protected.
     *
     * @var array The method(s) that should be publicly exposed.
     */
    protected static $passthru = [];

    public static function view(string $view)
    {
        return static::getTemplate()->setView($view);
    }
}
