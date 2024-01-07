<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package casaluna
 * @since 1.0.0
 */
if ( ! function_exists( 'rcid_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since UCSC 1.0.0
	 *
	 * @return void
	 */
	function casaluna_setup() {

		add_theme_support( 'wp-block-styles' );
		add_editor_style( 'build/style-index.css' );

/*
		* Load additional Core block styles.
		*/
		// $styled_blocks = array( '' );
		// foreach ( $styled_blocks as $block ) {

		// 	$name = explode('/', $block);
		// 	$args = array(
		// 		'handle' => "casaluna-$name[1]",
		// 		'src'    => get_theme_file_uri( "block-styles/$name[1].css" ),
		// 		$args['path'] = get_theme_file_path( "wp-blocks/$name[1].css" ),
		// 	);
		// 	wp_enqueue_block_style( $block, $args );
		// }
	}
endif;
add_action( 'after_setup_theme', 'casaluna_setup' );

/**
 * Enqueue theme scripts and styles.
 */
function casaluna_styles() {

	wp_enqueue_style(
		'casaluna-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'casaluna-styles-scss', get_template_directory_uri() . '/build/style-index.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'casaluna-google-fonts', 'hhttps://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Oswald:wght@200;300;400;500;600;700&display=swap', false );
	wp_register_script( 'casaluna-front', get_template_directory_uri() . '/build/theme.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'casaluna-front' );
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'casaluna_styles' );

/**
 * Enqueue additional Google Font Scripts
 */
function casaluna_googleapi_scripts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'casaluna_googleapi_scripts' );

/**
 * Register theme block pattern categories.
 */
function casaluna_register_block_pattern_categories(){
    register_block_pattern_category(
        'casaluna',
        array( 'label' => __( 'Casa Luna', 'casaluna' ) )
    );

}
add_action('init', 'casaluna_register_block_pattern_categories');

