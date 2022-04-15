<?php 

namespace Ditto;

class Functions {

    public $output;
    public $hash;
    public $argument;

    public function __construct( $output, $hash, $argument ) {
        $this->output   = $output;
        $this->hash     = $hash;
        $this->argument = $argument;
    }

    public function slugFormat($str, $delimiter = '-') {
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    }

    public function createFile( $type, $fileName, $contents ) {
        if( ! is_file( __DIR__ . "/../{$type}/{$fileName}.php") ):
            file_put_contents(__DIR__ . "/../{$type}/{$fileName}.php", $contents);
            $this->output->writeln( "{$type}/{$fileName}.php created." );
        else:
            $this->output->writeln( "The php file already exists." );
        endif;
    }

    public function createSassFile( $type, $fileName ) {
        if( ! is_file( __DIR__ . "/../sass/{$type}/_{$fileName}.scss") ):
            file_put_contents(__DIR__ . "/../sass/{$type}/_{$fileName}.scss", "#{$fileName}-template-{$this->hash} {\n\n}");
            $this->output->writeln( "sass/{$type}/_{$fileName}.scss created." );
            if( is_file( __DIR__ . "/../sass/main.scss" ) ):
                $mainSASS = file( __DIR__ . "/../sass/main.scss" );
                $anchor = $type === "templates" ? "#DittoTemplates" : "#DittoPartials";
                foreach ($mainSASS as $key => $line):
                    if(strpos($line, $anchor)): 
                        $mainSASS[$key] = "// {$anchor}\n@import './{$type}/{$fileName}';\n";
                        $this->output->writeln( "{$fileName} added to main.scss." );
                    endif;
                endforeach;
                file_put_contents(__DIR__ . "/../sass/main.scss", $mainSASS);
            else:
                $this->output->writeln( "sass/main.scss file not found." );
            endif;
        else:
            $this->output->writeln( "The sass file already exists." );
        endif;
    }

    public function reWriteFile( $filePath, $lineContains, $newLine ) {
        if( is_file( $filePath ) ):
            $file = file( $filePath );
            foreach ($file as $key => $line):
                if( strpos($line, $lineContains) !== false ): 
                    $file[$key] = "{$newLine}\n";
                    $this->output->writeln( "{$lineContains} changed." );
                endif;
            endforeach;
            file_put_contents( $filePath, $file);
        else:
            $this->output->writeln( "file doesn't exist." );
        endif;
    }

}