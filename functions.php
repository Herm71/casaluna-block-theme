<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package casaluna
 * @since 1.0.0
 */
if ( ! function_exists( 'casaluna_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since casaluna 1.0.0
	 *
	 * @return void
	 */
	function casaluna_setup() {

		add_theme_support( 'wp-block-styles' );
		add_editor_style( 'build/style-index.css' );

/*
		* Load additional Core block styles.
		*/
		$styled_blocks = array( 'core/details', 'core/post-excerpt' );
		foreach ( $styled_blocks as $block ) {

			$name = explode('/', $block);
			$args = array(
				'handle' => "rcid-$name[1]",
				'src'    => get_theme_file_uri( "block-styles/$name[1].css" ),
				$args['path'] = get_theme_file_path( "wp-blocks/$name[1].css" ),
			);
			wp_enqueue_block_style( $block, $args );
		}
		if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
			include_once get_parent_theme_file_path( 'vendor/autoload.php' );
		}
	}
endif;
add_action( 'after_setup_theme', 'casaluna_setup' );

/**
 * Enqueue theme block editor style script to modify the "styles" available for blocks in the editor.
 */
function casaluna_block_editor_scripts() {
	wp_enqueue_script( 'casaluna-editor', get_theme_file_uri( '/block-styles/styles.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'enqueue_block_editor_assets', 'casaluna_block_editor_scripts' );

/**
 * Enqueue theme scripts and styles.
 * <link rel='stylesheet' id='font-awesome-css' href='https://use.fontawesome.com/releases/v5.8.0/css/all.css' type='text/css' media='all' />
 */
function casaluna_styles() {

	wp_enqueue_style(
		'casaluna-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'casaluna-styles-scss', get_template_directory_uri() . '/build/style-index.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'casaluna-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Oswald:wght@200;300;400;500;600;700&display=swap', false );
	wp_register_script( 'casaluna-front', get_template_directory_uri() . '/build/theme.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'casaluna-front' );
	wp_register_script( 'casaluna-fontawesome', 'https://kit.fontawesome.com/5e58289d76.js', '', '', null );
	wp_enqueue_script( 'casaluna-fontawesome' );
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'casaluna_styles' );

/**
 * Add additional font awesome script tags.
 */
function casaluna_add_font_awesome_attributes( $tag, $handle, $src ) {
	if ( 'casaluna-fontawesome' === $handle ) {
		$tag = '<script src="' . esc_url( $src ) . '" id="casaluna-fontawesome-js" crossorigin="anonymous"></script>';
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'casaluna_add_font_awesome_attributes', 10, 3 );

/**
 * Enqueue additional Google Font Scripts
 */
function casaluna_api_scripts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'casaluna_api_scripts' );

/**
 * Register theme block pattern categories.
 */
function casaluna_register_block_pattern_categories() {
	register_block_pattern_category(
		'casaluna',
		array( 'label' => __( 'Casa Luna', 'casaluna' ) )
	);
}
add_action( 'init', 'casaluna_register_block_pattern_categories' );

/*
 * Load additional Core block styles.
 */
$styled_blocks = array( 'core/navigation' );
foreach ( $styled_blocks as $block ) {

	$name = explode( '/', $block );
	$args = array(
		'handle' => "casaluna-$name[1]",
		'src'    => get_theme_file_uri( "block-styles/$name[1].css" ),
		$args['path'] = get_theme_file_path( "block-styles/$name[1].css" ),
	);
	wp_enqueue_block_style( $block, $args );
}


/**
 * Enable SVG in Media Library.
 */
add_filter(
	'wp_check_filetype_and_ext',
	function ( $data, $file, $filename, $mimes ) {
		$filetype = wp_check_filetype( $filename, $mimes );
		return array(
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename'],
		);
	},
	10,
	4
);

function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

/**
 * Change Blog page title
 * instead of title of first blog post
 *
 * @param  string $block_content Block content to be rendered.
 * @param  array  $block         Block attributes.
 * @return string
 */
function casaluna_block_filter( $block_content = '', $block = array() ) {
	if ( is_home() ) {
		if ( isset( $block['blockName'] ) && 'core/post-title' === $block['blockName'] ) {
			if ( isset( $block['attrs']['className'] ) && $block['attrs']['className'] === 'blog-page-title' ) {
				$new_title   = get_the_title( get_option( 'page_for_posts' ) );
				$new_content = '<h2 style="font-style:normal;font-weight:600;text-transform:uppercase;" class="has-text-align-center blog-page-title wp-block-post-title has-x-large-font-size has-oswald-font-family">' . $new_title . '</h2>';
				$html        = str_replace(
					$block_content,
					$new_content,
					$block_content
				);
				return $html;

			}
		}
	}
	return $block_content;
}

add_filter( 'render_block', 'casaluna_block_filter', 10, 2 );

function casaluna_test() {
	if ( is_home() ) {
		$newTitle = get_the_title( get_option( 'page_for_posts' ) );
		$title    = $newTitle;
		echo $title;
	}
}

// add_action( 'wp_head', 'casaluna_test' );
