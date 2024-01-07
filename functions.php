<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package travelaero
 * @since 1.0.0
 */


function travelaero_styles() {

	wp_enqueue_style(
		'travelaero-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script( 
		'travelaero-custom-js', 
		get_template_directory_uri() . '/assets/js/custom.js', 
		array( 'jquery' ), 
		'20160412', 
		true 
	);

}
add_action( 'wp_enqueue_scripts', 'travelaero_styles' );


function travelaero_register_block_pattern_categories(){
    register_block_pattern_category(
        'travelaero',
        array( 'label' => __( 'Travel Aero', 'travelaero' ) )
    );

}
add_action('init', 'travelaero_register_block_pattern_categories');

require get_template_directory() . '/tgm-plugin/tgm-hook.php';