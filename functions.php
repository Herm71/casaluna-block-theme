<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package casaluna
 * @since 1.0.0
 */


function casaluna_styles() {

	wp_enqueue_style(
		'casaluna-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script( 
		'casaluna-custom-js', 
		get_template_directory_uri() . '/assets/js/custom.js', 
		array( 'jquery' ), 
		'20160412', 
		true 
	);

}
add_action( 'wp_enqueue_scripts', 'casaluna_styles' );


function casaluna_register_block_pattern_categories(){
    register_block_pattern_category(
        'casaluna',
        array( 'label' => __( 'Casa Luna', 'casaluna' ) )
    );

}
add_action('init', 'casaluna_register_block_pattern_categories');

