<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    /** @var Command[] */
    protected array $commands;

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $output->writeln('Importing Products Data');
        foreach ($this->commands as $command) {
            $output->writeln('Running <info>' . $command->getName() . '</info>...');
            $command->up();
        }

        $output->writeln('Just Done!');

        return 0;
    }
}
