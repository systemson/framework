<?php

namespace Amber\Framework\Helpers;

use Carbon\Carbon;

class Amber
{
    const VERSION = 'v-dev';
    const NAME = 'Amber Framework';

    public function version(): string
    {
        return self::VERSION;
    }

    public function name(): string
    {
        return self::NAME;
    }

    public function lap(): float
    {
        return number_format(microtime(true) - INIT_TIME, 6);
    }

    public function date(): Carbon
    {
        return Carbon::now();
    }
}
