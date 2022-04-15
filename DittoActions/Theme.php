<?php 

namespace Ditto;

class Theme {

    protected $functions;
    protected $stylePath = __DIR__ . "/../style.css";

    public function __construct( Functions $functions  ) {
        $this->functions = $functions;
    }

    public function name() {
        $this->functions->reWriteFile( $this->stylePath, "Theme Name", "Theme Name: {$this->functions->argument}" );
    }

    public function uri() {
        $this->functions->reWriteFile( $this->stylePath, "Theme URI", "Theme URI: {$this->functions->argument}" );
    }

    public function description() {
        $this->functions->reWriteFile( $this->stylePath, "Description", "Description: {$this->functions->argument}" );
    }

    public function version() {
        $this->functions->reWriteFile( $this->stylePath, "Version", "Version: {$this->functions->argument}" );
    }

}