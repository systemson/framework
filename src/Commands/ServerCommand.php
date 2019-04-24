<?php

namespace Amber\Framework\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Carbon\Carbon;

class ServerCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'run';

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $phpVersion = phpversion();
        $now = Carbon::now();
        $port = '3000';

        $output->writeln("PHP {$phpVersion} Development Server started at {$now}");
        $output->writeln("Listening on http://localhost:{$port}");
        $output->writeln("Amber Framework v-beta.");
        $output->writeln("Never use this server on production.");
        $output->writeln("Press Ctrl-C to quit.");
        
        exec('php -S localhost:3000 -t public');
    }
}
