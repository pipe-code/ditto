<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Leafo\ScssPhp\Compiler;

class CompileSassCommand extends Command {
    protected $commandName = 'compile:sass';
    protected $commandDescription = "Compile sass/main.scss file.";

    protected function configure() {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription);
    }
    protected function execute(InputInterface $input, OutputInterface $output) {
            
        $scss = new Compiler();
        $scss->setImportPaths('sass/');
        if(is_file('sass/main.scss')){
            $css = $scss->compile('@import "main.scss";');
            if(is_file('css/main.css')){
                $output->writeln('css/main.css updated.');
            } else {
                $output->writeln('css/main.css created.');
            }
            file_put_contents('css/main.css', $css);
        } else {
            $output->writeln("The file sass/main.scss doesn't exist.");
        }

    }
}