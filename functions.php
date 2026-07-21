<?php
/**
 * File:	functions.php
 * Theme:	Lumina 
 * 
 * Lumina functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lumina
 * @since	1.0
 */

/**
 * Load the themes PHP include files, such as block patterns
 */
 
// Build array of include files relative to theme root
$includes = array (
	'/inc/add-body-classes.php',
	'/inc/default-image.php',
	'/inc/parent-theme.php',
// 	'/inc/category-colors.php',
// 	'/inc/ image-move-border.php',
// 	'/inc/inline-excerpt.php',
);

// Allow child themes to override the list of PHP files to load
$includes = apply_filters( 'lumina_load_includes', $includes );

// Load each of the include files
foreach ( $includes as $include ) {
	if ( file_exists( get_stylesheet_directory() . $include ) ) {
		include_once get_stylesheet_directory() . $include;
// 		require_once get_stylesheet_directory() . $include;
	}
}

/**
 * Sets up theme defaults and registers support for various WordPress features
 */
add_action( 'after_setup_theme', 'lumina_theme_support' );

if ( ! function_exists( 'lumina_theme_support' ) ) :

	function lumina_theme_support() {

		// Set the standard post thumbnail image size for the blog (Center Cropped)
// 		set_post_thumbnail_size( 1100, 619, true );
				
		// Also add this as a selectable size in the Block Editor (Center Cropped)
// 		add_image_size( 'cropped-large', 1100, 619, true );

		// And add a smaller size for recent posts in columns (Center Cropped)
// 		add_image_size( 'cropped-thumbnail', 760, 428, true );

		// Add a half-height 16:4.5 image (Center Cropped)
		add_image_size( 'cropped-slim', 1100, 309, true );

		// Enqueue the styles needed for the editor. Do this here to 
		// avoid interfering with the Editor UI. 
// 		$editor_styles = array(
// 			'/assets/css/lumina-theme.css',
// 			'/assets/css/lumina-engine.css',
// // 			'/assets/css/editor-styles.css',
// 		);
// 
// 		// Load the editor styles
// 		add_editor_style( $editor_styles ); 		
	}
endif;

/**
 * Add our custom image size(s) to the list that user can pick in the editor.
 * Note: Medium Large is standard WordPress 768px but isn't exposed to the 
 * user by default.
 */
add_filter( 'image_size_names_choose', 'lumina_image_sizes' );

if ( ! function_exists( 'lumina_image_sizes' ) ) :
	function lumina_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
// 			'cropped-thumbnail' => __( 'Lumina Column Feature (760px cropped)', 'lumina' ),
// 			'medium-large' 		=> __( 'Medium Large (768px)', 'lumina' ),
// 			'cropped-large' 	=> __( 'Lumina Page Hero (1100px cropped)', 'lumina' ),		
			'cropped-slim' 		=> __( 'Lumina Slim Banner 16:4.5 (1100px cropped)', 'lumina' ),
		) );
	}
endif;

/**
 * LUMINA THEME CSS
 */
function lumina_load_styles() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;

	// Set the CSS path and URI
    $css_uri = get_stylesheet_directory_uri() . '/assets/css/lumina-theme.css';
    $css_path = get_stylesheet_directory() . '/assets/css/lumina-theme.css';

    // Lumina Engine Resting State CSS
	if ( file_exists( $css_path ) ) {

		// Use specific asset version if there is one
		$asset = str_replace( '.css', '.asset.php', $css_path );
		$asset_file = include( $asset );
		if ( $asset_file['version'] ) {
			$asset_version = $asset_file['version'];
		}

        wp_register_style(
            'lumina-theme',
            $css_uri,
			array(),            
			$asset_version ?? $version
        );
        
		wp_enqueue_style( 'lumina-theme' );
    }
}

// add_action( 'wp_enqueue_scripts', 'lumina_load_styles' );
add_action( 'enqueue_block_assets', 'lumina_load_styles' );

/**
 * LUMINA BLOCK CSS: Load individual block styles.
 */

// if ( ! function_exists( 'lumina_load_block_styles' ) ) :
// 
// 	function lumina_load_block_styles() {
// 
// 		// Setup block styles path
// 		$block_path = '/assets/css/blocks/';
// 
// 		// Get Block CSS build version from the combined block style asset
// // 		if ( file_exists ( get_template_directory() . $block_path. 'block-styles.asset.php' ) ) {
// // 			$asset_file = include( get_template_directory() . $block_path . 'block-styles.asset.php' );
// // 			$block_css_version = $asset_file['version'] ?? false;
// // 		} else {
// 			$block_css_version = wp_get_theme()->get( 'Version' ) ?? false;
// // 		}
// 
// 		// Load the styles for the individual blocks
// 		$block_styles = glob( get_theme_file_path($block_path) . '*.css' ); 
// 		foreach ( $block_styles as $block_name ) {
// 
// 			// Remove the path and .css extension from the name
// 			$block_name = str_replace( array(get_theme_file_path($block_path), '.css'), '', $block_name );
// 
// 			// Skip the combined block file since loading individual block styles and
// 			// skip the RTL versions because we will add them as a replacement
// 			if ( strpos( $block_name, 'block-styles' ) === false
// 				&& strpos( $block_name, '-rtl' ) === false ) {
// 
// 				// Load the block style. WordPress will decide whether to enqueue or 
// 				// inline the style. Add RTL language support too.
// 				wp_enqueue_block_style( "core/$block_name", array(
// 					'handle' => "lumina-block-$block_name",
// 					'src'    => get_theme_file_uri( $block_path . "$block_name.css" ),
// 					'path'   => get_theme_file_path( $block_path . "$block_name.css" ),
// 					'deps'	 => array( 'lumina-theme' ), 
// 					'ver'	 => $block_css_version
// 				) );
// 				wp_style_add_data( "lumina-block-$block_name", 'rtl', 'replace' );
// 			}			
// 		}
// 	}
// endif;
// 
// add_action( 'init', 'lumina_load_block_styles' ); 

/**
 * LUMINA PHYSICS CSS: Load core engine on front-end and backend. Load 
 * animation only on the front-end.
 */
function lumina_load_physics_styles() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;
    
    // Get the Lumina Engine css
    $engine_uri = get_stylesheet_directory_uri() . '/assets/css/lumina-engine.css';
    $engine_path = get_stylesheet_directory() . '/assets/css/lumina-engine.css';
    
    $interaction_uri = get_stylesheet_directory_uri() . '/assets/css/lumina-interactions.css';
    $interaction_path = get_stylesheet_directory() . '/assets/css/lumina-interactions.css';

    // 1. REGISTER handles for CSS first to establish the "library"
    
    // Lumina Engine Resting State CSS
// 	if ( ! is_admin()	
//     	AND file_exists( $engine_path ) ) {
	if ( file_exists( $engine_path ) ) {

		// Use specific asset version if there is one
		$asset = str_replace( '.css', '.asset.php', $engine_path );
		$asset_file = include( $asset );
		if ( $asset_file['version'] ) {
			$asset_version = $asset_file['version'];
		}

        wp_register_style(
            'lumina-engine',
            $engine_uri,
            array('lumina-theme'),
			$asset_version ?? $version
        );
    }

	// Lumina Engine Interactive State CSS
	if ( ! is_admin()	
    	AND file_exists( $interaction_path ) ) {

		// Use specific asset version if there is one
		$asset = str_replace( '.css', '.asset.php', $interaction_path );
		$asset_file = include( $asset );
		if ( $asset_file['version'] ) {
			$asset_version = $asset_file['version'];
		}

        wp_register_style(
            'lumina-interactions',
            $interaction_uri,
            array('lumina-engine'), 
			$asset_version ?? $version
        );
    }

    // 2. ENQUEUE CSS - This actually puts them on the page
// 	if ( ! is_admin() ) {
	    wp_enqueue_style( 'lumina-engine' );

	if ( ! is_admin() ) {
    	wp_enqueue_style( 'lumina-interactions' );
    }    
}

// add_action( 'wp_enqueue_scripts', 'lumina_load_physics_styles' );

// if ( ! is_admin() ) {
	add_action( 'enqueue_block_assets', 'lumina_load_physics_styles' );
// }

/**
 * LUMINA GRAVITY ENGINE JS: Only on Front-end.
 */
function lumina_load_scripts() {

    $js_uri = get_stylesheet_directory_uri() . '/assets/js/lumina-physics.js';
    $js_path = get_stylesheet_directory() . '/assets/js/lumina-physics.js';

	if ( ! is_admin()	
    	AND file_exists( $js_path ) ) {

		$theme_version = wp_get_theme()->get( 'Version' ) ?? false;			
		wp_enqueue_script( 
			'lumina-physics', 
			$js_uri,
			array('jquery'), 
			$theme_version, 
			$in_footer = true 
		);
	}
}

// Conditionally load javascript that turns cards into links
if ( apply_filters( 'lumina_card_link_js', true ) ) {
	add_action( 'wp_enqueue_scripts', 'lumina_load_scripts' );
}

/**
 * Register additional block pattern categories
 * 
 * WordPress already has categories for featured, header, query, text, buttons,
 * gallery, banner, footer, call-to-action, team, testimonials, services,
 * contract, about, portfolio, and media.
 */
if ( ! function_exists( 'lumina_register_pattern_categories' ) ) :

	function lumina_register_pattern_categories() {

		// Add our own block pattern categories
		$block_pattern_categories = array(
			'lumina'	=> array( 'label' => __( 'All Lumina', 'lumina' ) ),
// 			'column'   		=> array( 'label' => __( 'Columns', 'lumina' ) ),				
// 			'page'    		=> array( 'label' => __( 'Pages', 'lumina' ) ),
		);
		
		/**
		 * Filters the theme block pattern categories.
		 *
		 * @param array[] $block_pattern_categories {
		 *     An associative array of block pattern categories, keyed by category name.
		 *
		 *     @type array[] $properties {
		 *         An array of block category properties.
		 *
		 *         @type string $label A human-readable label for the pattern category.
		 *     }
		 * }
		 */
		$block_pattern_categories = apply_filters( 'lumina_block_pattern_categories', $block_pattern_categories );

		foreach ( $block_pattern_categories as $name => $properties ) {
			if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
				register_block_pattern_category( $name, $properties );
			}
		}	
	}
endif;
