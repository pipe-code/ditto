<?php 

namespace Ditto;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterCommand extends Command {

    public function __construct( $name, $description, $argument, $argumentDescription ) {
        parent::__construct(
            $this->commandName                  = $name,
            $this->commandDescription           = $description,
            $this->commandArgumentName          = $argument,
            $this->commandArgumentDescription   = $argumentDescription
        );
    }

    protected function configure() {
        $this
            ->setName( $this->commandName )
            ->setDescription( $this->commandDescription )
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::REQUIRED,
                $this->commandArgumentDescription
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $functions = new Functions( 
            $output, 
            bin2hex(random_bytes(3)), 
            $input->getArgument($this->commandArgumentName) 
        );

        $make   = new Make( $functions );
        $theme  = new Theme( $functions );

        switch ($this->commandName):
            case "make:template":
                $make->template();
                break;

            case "make:partial":
                $make->partial();
                break;

            case "theme:name":
                $theme->name();
                break;

            case "theme:uri":
                $theme->uri();
                break;

            case "theme:description":
                $theme->description();
                break;
                
            case "theme:version":
                $theme->version();
                break;
            
            default:
                $output->writeln( "Command not found." );
                break;
        endswitch;
    }

}