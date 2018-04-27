<?php

namespace Legato\Framework;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlaceHolder extends Command
{
    /**
     * Identifier for the console command
     *
     * @var string
     */
    protected $commandName = 'namespace:command';
    
    /**
     * Command description
     *
     * @var string
     */
    protected $description = 'The command description';
    
    public function __construct($name = null)
    {
        parent::__construct($name);
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        //
    }
}