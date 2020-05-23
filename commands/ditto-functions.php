<?php
namespace Ditto\Functions;

class Content {
    static function Template($name) {
        $output =   "   
<?php
/**
 * 
 * Template Name: ".$name."
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<main id=".'"'.Convert::Slug($name).'-template"'."></main>
<?php get_footer(); ?>
                    ";
		return $output;
    }
    static function Partial($name) {
        $output =   "   
<?php
/**
 * 
 * Partial Name: ".$name."
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<section class=".'"'.Convert::Slug($name).'-partial"'."></section>
                    ";
		return $output;
	}
}

class Convert {
    static function Slug($str, $delimiter = '-') {
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    }
}