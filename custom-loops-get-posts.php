<?php
/*
Plugin Name:  Custom Loops: get_posts()
Description:  Demonstrates how to customise the WP loop using get_posts()e
Plugin URI:   https://aliciarodriguezweb.com
Author:       Alicia Rodriguez
Version:      1.0
*/
// text domain --> needed for internationalisation. Must match the plugin folder and main plugin file.
// domain path --> needed for internationalisation. Must much the languages folder

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}


// Get custom set of posts

// Custom loop shortcode: [get_posts_example]
// Getting the shortcode according to the ShortCode API
function custom_loop_shortcode_get_posts( $atts ) {

    // Get global post variable
    global $post;

    // Define shortcode variables
    extract( shortcode_atts( array (
        'posts_per_page' => 5, // supported attributes and their defaults, called 'pairs'
        'orderby' => 'date'
    ), $atts ) ); // user defined attributes in shortcode tag (it is an argument)

    // Define get_post parameters
    $args = array ( 'posts_per_page' => $posts_per_page, 'orderby' => $orderby);

    // Get the posts
    $posts = get_posts( $args );

    // Begin output variable
    $output = '<h3>Custom loop example: get_posts()</h3>';
    $output .= '<ul>';

    // Loop through posts
    foreach ( $posts as $post ) {

        // Prepare post data
        setup_postdata( $post ); // It initialises some global variables for the post to be ready, like $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages

        // Continue output variable
        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title( $post ) .'</a></li>';        
    }

    // Reset postdata
    wp_reset_postdata();

    // Complete output variable
    $output .= '</ul>';

    // Return output
    return $output;

}

// Register shortcode function
add_shortcode( 'get_posts_example', 'custom_loop_shortcode_get_posts' );