<?php

namespace Amber\Framework\Container\Providers;

use Dotenv\Dotenv;

class DotenvServiceProvider extends ServiceProvider
{
    public static function boot(): void
    {
    	if (file_exists(APP_DIR . '.env')) {
        	$dotenv = Dotenv::create(APP_DIR);
        	$dotenv->load();
    	}
    }
}
