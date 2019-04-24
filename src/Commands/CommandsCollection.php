<?php

namespace Amber\Framework\Commands\CommandsCollection;

use Amber\Collection\Collection;

class CommandsCollection extends Collection
{
    public function __construct()
    {
        parent::__construct([]);

        $this->push([
            Framework\Commands\MigrationCommand::class,
            Framework\Commands\AppCacheCommand::class,
        ]);
    }
}
