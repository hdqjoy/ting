<?php
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
// use think\console\input\Option;
use think\console\Output;

class Test extends Command
{

    protected function configure()
    {
        $this->setName('test')
            ->addArgument('cmd', Argument::OPTIONAL, "input cmd")
            ->setDescription('Command Test');
    }

    protected function execute(Input $input, Output $output)
    {
        $name = trim($input->getArgument('cmd'));
        $name = $name?:'test command';
        $output->writeln("TestCommand:".$name);
    }
}