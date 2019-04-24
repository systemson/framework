<?php

namespace Amber\Framework\Container\Facades;

use Amber\Framework\Container\ContainerFacade;
use Amber\Framework\Auth\AuthClass;

class Auth extends ContainerFacade
{
    /**
     * @var string The class accessor.
     */
    protected static $accessor = AuthClass::class;

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
}
