<?php

namespace Amber\Framework\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrationCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration';

    protected function configure()
    {
        //$this->addArgument('direction', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Running migrations');

        include APP_DIR . 'database/migrations.php';
    }
}
