<?php

namespace Amber\Framework\Container\Facades;

use Amber\Framework\Http\Security\Csrf as BaseCsrf;
use Amber\Framework\Container\ContainerFacade;

class Csrf extends ContainerFacade
{
    /**
     * @var string The class accessor.
     */
    protected static $accessor = BaseCsrf::class;

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
