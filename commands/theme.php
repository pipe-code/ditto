<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Ditto\Functions;

require_once('ditto-functions.php');

class ThemeNameCommand extends Command {
    protected $commandName = 'theme:name';
    protected $commandDescription = "Change the name theme.";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "What name will the theme have?";

    protected function configure() {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output) {
        $themeName = $input->getArgument($this->commandArgumentName);
        $styleTheme = 'style.css';
        if ($themeName) {
            if(is_file($styleTheme)) {
                $slug = Functions\Convert::Slug($themeName);
                $lines = file($styleTheme);
                $lines[1] = 'Theme Name: '.$themeName."\n";
                $lines[2] = 'Theme URI: '.$slug."\n";
                file_put_contents($styleTheme, preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $lines));
                $output->writeln("The theme name was changed to ".$themeName);
            } else {
                $output->writeln("style.css doesn't exist.");
            }
        } else {
            $output->writeln('Type the theme name.');
        }
    }
}