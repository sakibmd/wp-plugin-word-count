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


// function wordcount_activation_hook(){}
// register_activation_hook(__FILE__, "wordcount_activation_hook");


// function wordcount_deactivation_hook(){}
// register_deactivation_hook(__FILE__, "wordcount_deactivation_hook");


function wordcount_load_textdomain(){
    load_plugin_textdomain('word-count', false, dirname(__FILE__)."/languages");
}

add_action("plugins_loaded", "wordcount_load_textdomain");


function wordcount_count_words($content){
    $stripped_tags = strip_tags($content);
    $wordn = str_word_count($stripped_tags);
    $label = __('Total Number of words:', 'word-count');
    $label = apply_filters("wordcount_heading", $label);
    $tag = apply_filters("wordcount_tag", "p");
    $content .= sprintf("<%s>%s %s</%s>", $tag, $label, $wordn, $tag);
    do_action('wordcount_post_description_title');

    return $content;
}

add_filter('the_content', 'wordcount_count_words');




function wordcount_heading_callback($heading){
    $heading = "Total Words: ";
    return $heading;
}
add_filter('wordcount_heading', 'wordcount_heading_callback');







function wordcount_tag_callback($tag){
    $tag = "strong";
    return $tag;
}
add_filter('wordcount_tag', 'wordcount_tag_callback');









function wordcount_reading_time($content){

    $stripped_tags = strip_tags($content);
    $wordn = str_word_count($stripped_tags);
    $reading_minute = floor($wordn/200);
    $reading_seconds = floor( $wordn % 200 / (200/60) );
    $is_visible = apply_filters("wordcount_display_readingtime", 1);
    if($is_visible){
        $label = __('Total Reading Time:', 'word-count');
        $label = apply_filters("wordcount_reading_heading", $label);
        $tag = apply_filters("wordcount_reading_tag", "h3");
        $content .= sprintf("<%s>%s %s minutes %s seconds</%s>", $tag, $label, $reading_minute, $reading_seconds, $tag);
    }
    
    return $content;
}
add_filter("the_content", "wordcount_reading_time");

function wordcount_reading_tag_callback($tag){
    $tag = "h4" ;
    return $tag;
}
add_filter('wordcount_reading_tag', 'wordcount_reading_tag_callback');



function wordcount_post_description_title_callback(){
    echo "<h6>Description (using action hook)</h6>";
}


add_action("wordcount_post_description_title", "wordcount_post_description_title_callback");

?>