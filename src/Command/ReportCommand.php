<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 13:08
 */

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReportCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('report:send');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('teste');
    }
}