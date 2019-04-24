<?php

namespace Amber\Framework\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

class AppCacheCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'cache:clear';

    protected function configure()
    {
        $this->addArgument('folder', InputArgument::REQUIRED, 'The cache folder to clear.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $folder = $input->getArgument('folder');

        $filesystem = new Filesystem(new Local(config('filesystem')->cache['path']));

        $output->writeln("Clearing {$folder} cache folder.");
        
        switch ($folder) {
            case 'views':
                $folder = 'views';
                $contents = $filesystem->listContents($folder);
                foreach ($contents as $file) {
                    $filesystem->delete($file['path']);
                    $output->writeln("Clearing file [{$file['path']}] from {$folder} cache folder.");
                }
                break;
            
            default:
                $output->writeln('No such cache folder.');
                break;
        }

        $output->writeln('Job done.');
    }
}
