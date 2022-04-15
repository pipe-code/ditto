<?php 

namespace Ditto;

class Make {

    protected $functions;

    public function __construct( Functions $functions  ) {
        $this->functions = $functions;
    }

    public function template() {
        $fileName = $this->functions->slugFormat( $this->functions->argument );
        $template = file_get_contents(__DIR__ . "/templates/template.txt");
        $contents = str_replace(["-%template-name%-", "-%id%-"], [$this->functions->argument, "{$fileName}-template-{$this->functions->hash}"], $template);

        // Create wordpress template file
        $this->functions->createFile( "templates", $fileName, $contents );

        // Create sass file
        $this->functions->createSassFile( "templates", $fileName );
    }

    public function partial() {
        $fileName = $this->functions->slugFormat( $this->functions->argument );
        $template = file_get_contents(__DIR__ . "/templates/partial.txt");
        $contents = str_replace(["-%partial-name%-", "-%class%-"], [$this->functions->argument, "{$fileName}-partial-{$this->functions->hash}"], $template);

        // Create wordpress partial file
        $this->functions->createFile( "partials", $fileName, $contents );

        // Create sass file
        $this->functions->createSassFile( "partials", $fileName );
    }

}