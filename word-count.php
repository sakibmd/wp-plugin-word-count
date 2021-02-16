<?php

/**
 * Plugin Name:       Word Count
 * Plugin URI:        https://sakibmd.xyz/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sakib Mohammed
 * Author URI:        https://sakibmd.xyz/
 * License:           GPL v2 or later
 * License URI:       
 * Text Domain:       word-count
 * Domain Path:       /languages
 */


// function wordcount_activation_hook(){

// }

// register_activation_hook(__FILE__, "wordcount_activation_hook");


// function wordcount_deactivation_hook(){

// }

// register_deactivation_hook(__FILE__, "wordcount_deactivation_hook");


function wordcount_load_textdomain(){
    load_plugin_textdomain('word-count', false, dirname(__FILE__)."/languages");
}

add_action("plugins_loaded", "wordcount_load_textdomain");


function wordcount_count_words($content){
    $stripped_tags = strip_tags($content);
    $wordn = str_word_count($stripped_tags);
    $label = __('Total Number of words:', 'word-count');
    $content .= sprintf("<p>%s = %s</p>", $label, $wordn);
    return $content;
}


add_filter('the_content', 'wordcount_count_words');



?>