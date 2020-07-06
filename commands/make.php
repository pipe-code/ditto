<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ditto\Functions;

require_once('ditto-functions.php');

class MakeTemplateCommand extends Command {
    protected $commandName = 'make:template';
    protected $commandDescription = "Make a WordPress Template";

    protected $commandArgumentName = "template name";
    protected $commandArgumentDescription = "What name will your template have?";

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
        $templateName = $input->getArgument($this->commandArgumentName);
        $randomHash = bin2hex(random_bytes(3));

        if ($templateName) {
            
            $fileName = Functions\Convert::Slug($templateName).'-template';
            if(!is_file('templates/'.$fileName.'.php')){
                $contents = Functions\Content::Template($templateName, $randomHash);
                file_put_contents('templates/'.$fileName.'.php', $contents);
                $output->writeln($fileName.'.php created.');
                if(!is_file('sass/templates/'.$fileName.'.scss')){
                    file_put_contents('sass/templates/_'.$fileName.'.scss', '#'.Functions\Convert::Slug($templateName).'-template-'.$randomHash.' {}');
                    $mainSASS = file('sass/main.scss');
                    foreach ($mainSASS as $key => $line) {
                        if(strpos($line, '#DittoTemplates')) {
                            $mainSASS[$key] = '// #DittoTemplates'."\n".'@import "./templates/'.$fileName.'";'."\n";
                        }
                    }
                    file_put_contents('sass/main.scss', $mainSASS);
                    $output->writeln('sass/partials/_'.$fileName.'.scss created.');
                }
            } else {
                $output->writeln('The template already exists.');
            }
        } else {
            $output->writeln('Type the template name.');
        }
    }
}

class MakePartialCommand extends Command {
    protected $commandName = 'make:partial';
    protected $commandDescription = "Make a WordPress partial";

    protected $commandArgumentName = "partial name";
    protected $commandArgumentDescription = "What name will your partial have?";

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
        $partialName = $input->getArgument($this->commandArgumentName);
        $randomHash = bin2hex(random_bytes(3));
        if ($partialName) {
            
            $fileName = str_replace(' ', '', $partialName);
            if(!is_file('partials/'.$fileName.'.php')){
                $contents = Functions\Content::Partial($partialName, $randomHash);
                file_put_contents('partials/'.$fileName.'.php', $contents);
                $output->writeln('partials/'.$fileName.'.php created.');
                if(!is_file('sass/partials/'.$fileName.'.scss')){
                    file_put_contents('sass/partials/_'.$fileName.'.scss', '.'.Functions\Convert::Slug($partialName).'-partial-'.$randomHash.' {}');
                    $mainSASS = file('sass/main.scss');
                    foreach ($mainSASS as $key => $line) {
                        if(strpos($line, '#DittoPartials')) {
                            $mainSASS[$key] = '// #DittoPartials'."\n".'@import "./partials/'.$fileName.'";'."\n";
                        }
                    }
                    file_put_contents('sass/main.scss', $mainSASS);
                    $output->writeln('sass/partials/_'.$fileName.'.scss created.');
                }
            } else {
                $output->writeln('The partial already exists.');
            }
        } else {
            $output->writeln('Type the partial name.');
        }
    }
}