<?php

namespace Amber\Framework\Container\Providers;

use Illuminate\Database\Capsule\Manager as Eloquent;

class ModelServiceProvider extends ServiceProvider
{
    public static function boot(): void
    {
        $eloquent = new Eloquent();

        $eloquent->addConnection(config('database')->pgsql);
        $eloquent->setAsGlobal();
        $eloquent->bootEloquent();
    }
}
