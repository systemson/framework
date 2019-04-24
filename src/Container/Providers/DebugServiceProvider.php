<?php

namespace Amber\Framework\Container\Providers;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class DebugServiceProvider extends ServiceProvider
{
    public static function boot(): void
    {
    	if (getenv('APP_ENV') == 'dev') {
	        $whoops = new \Whoops\Run();
	        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
	        $whoops->register();
    	}
    }
}
