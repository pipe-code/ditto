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
    protected $commandDescription = "Change the theme name.";

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

class ThemeDescriptionCommand extends Command {
    protected $commandName = 'theme:description';
    protected $commandDescription = "Change the theme description.";

    protected $commandArgumentName = "description";
    protected $commandArgumentDescription = "What description will the theme have?";

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
        $themeDescription = $input->getArgument($this->commandArgumentName);
        $styleTheme = 'style.css';
        if ($themeDescription) {
            if(is_file($styleTheme)) {
                $lines = file($styleTheme);
                $lines[3] = 'Description: '.$themeDescription."\n";
                file_put_contents($styleTheme, preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $lines));
                $output->writeln("The theme description was changed.");
            } else {
                $output->writeln("style.css doesn't exist.");
            }
        } else {
            $output->writeln('Type the theme description.');
        }
    }
}

class ThemeVersionCommand extends Command {
    protected $commandName = 'theme:version';
    protected $commandDescription = "Change the theme version.";

    protected $commandArgumentName = "version";
    protected $commandArgumentDescription = "What version will the theme have?";

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
        $themeversion = $input->getArgument($this->commandArgumentName);
        $styleTheme = 'style.css';
        if ($themeversion) {
            if(is_file($styleTheme)) {
                $lines = file($styleTheme);
                $lines[6] = 'Version: '.$themeversion."\n";
                file_put_contents($styleTheme, preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $lines));
                $output->writeln("The theme version was changed.");
            } else {
                $output->writeln("style.css doesn't exist.");
            }
        } else {
            $output->writeln('Type the theme version.');
        }
    }
}