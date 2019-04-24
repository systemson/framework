<?php

namespace Amber\Framework\Container\Providers;

use Amber\Sketch\Sketch;
use Amber\Sketch\Template\Template;

class ViewServiceProvider extends ServiceProvider
{
    public function setUp(): void
    {
        $container = static::getContainer();

        $container->bind('Amber\Framework\Helpers\Amber');

        $container->singleton(Sketch::class)
            ->afterConstruct('setViewsFolder', 'assets/views')
            ->afterConstruct('setCacheFolder', 'tmp/cache/views')
            ->afterConstruct(
                'setTemplate',
                function () use ($container) {
                    return $container->get(Template::class);
                }
            )
            ->afterConstruct(
                'setTag',
                'authname',
                '<?= Amber\Framework\Container\Facades\Auth::name(); ?>'
            )
            ->afterConstruct(
                'setTag',
                'appname',
                '<?= getenv(\'APP_NAME\'); ?>'
            )
            ->afterConstruct(
                'setTag',
                'lap',
                '<?= number_format(microtime(true) - INIT_TIME, 6); ?>'
            )
            ->afterConstruct(
                'setTag',
                'appversion',
                '<?= Amber\Framework\Container\Facades\Amber::version(); ?>'
            )
        ;
    }
}
