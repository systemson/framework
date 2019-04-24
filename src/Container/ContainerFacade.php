<?php

namespace Amber\Framework\Container;

use Amber\Utils\Implementations\AbstractWrapper;

class ContainerFacade extends AbstractWrapper
{
    use StaticContainerAwareTrait;

    /**
     * Returns the instance of the class.
     */
    public static function getInstance()
    {
        $accesor = static::getAccessor();

        if (!static::$instance instanceof $accesor) {
            static::beforeConstruct();

            static::$instance = static::getContainer()->get($accesor);

            static::afterConstruct();
        }

        return static::$instance;
    }
}
