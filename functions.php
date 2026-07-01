<?php
/**
 * File:	functions.php
 * Theme:	Atmos Blocks 
 * 
 * Atmos Blocks functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package atmos-blocks
 * @since	1.0
 */

/**
 * Load the themes PHP include files, such as block patterns
 */
 
// Build array of include files relative to theme root
$includes = array (
	'/inc/default-image.php',
	'/inc/add-body-classes.php',
// 	'/inc/category-colors.php',
// 	'/inc/ image-move-border.php',	
);

// Allow child themes to override the list of PHP files to load
$includes = apply_filters( 'atmos_load_includes', $includes );

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
add_action( 'after_setup_theme', 'atmos_theme_support' );

if ( ! function_exists( 'atmos_theme_support' ) ) :

	function atmos_theme_support() {

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
// 			'/assets/css/atmos-theme.css',
// 			'/assets/css/atmos-engine.css',
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
add_filter( 'image_size_names_choose', 'atmos_image_sizes' );

if ( ! function_exists( 'atmos_image_sizes' ) ) :
	function atmos_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
// 			'cropped-thumbnail' => __( 'Atmos Column Feature (760px cropped)', 'atmos-blocks' ),
// 			'medium-large' 		=> __( 'Medium Large (768px)', 'atmos-blocks' ),
// 			'cropped-large' 	=> __( 'Atmos Page Hero (1100px cropped)', 'atmos-blocks' ),		
			'cropped-slim' 		=> __( 'Atmos Slim Banner 16:4.5 (1100px cropped)', 'atmos-blocks' ),
		) );
	}
endif;

/**
 * ATMOS THEME CSS
 */
function atmos_load_styles() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;

	// Set the CSS path and URI
    $css_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-theme.css';
    $css_path = get_stylesheet_directory() . '/assets/css/atmos-theme.css';

    // Atmos Engine Resting State CSS
	if ( file_exists( $css_path ) ) {

		// Use specific asset version if there is one
		$asset = str_replace( '.css', '.asset.php', $css_path );
		$asset_file = include( $asset );
		if ( $asset_file['version'] ) {
			$asset_version = $asset_file['version'];
		}

        wp_register_style(
            'atmos-theme',
            $css_uri,
			array(),            
			$asset_version ?? $version
        );
        
		wp_enqueue_style( 'atmos-theme' );
    }
}

// add_action( 'wp_enqueue_scripts', 'atmos_load_styles' );
add_action( 'enqueue_block_assets', 'atmos_load_styles' );

/**
 * ATMOS PHYSICS CSS: Load core engine on front-end and backend. Load 
 * animation only on the front-end.
 */
function atmos_load_physics_styles() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;
    
    // Get the Atmos Engine css
    $engine_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-engine.css';
    $engine_path = get_stylesheet_directory() . '/assets/css/atmos-engine.css';
    
    $interaction_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-interactions.css';
    $interaction_path = get_stylesheet_directory() . '/assets/css/atmos-interactions.css';

    // 1. REGISTER handles for CSS first to establish the "library"
    
    // Atmos Engine Resting State CSS
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
            'atmos-engine',
            $engine_uri,
            array('atmos-theme'),
			$asset_version ?? $version
        );
    }

	// Atmos Engine Interactive State CSS
	if ( ! is_admin()	
    	AND file_exists( $interaction_path ) ) {

		// Use specific asset version if there is one
		$asset = str_replace( '.css', '.asset.php', $interaction_path );
		$asset_file = include( $asset );
		if ( $asset_file['version'] ) {
			$asset_version = $asset_file['version'];
		}

        wp_register_style(
            'atmos-interactions',
            $interaction_uri,
            array('atmos-engine'), 
			$asset_version ?? $version
        );
    }

    // 2. ENQUEUE CSS - This actually puts them on the page
// 	if ( ! is_admin() ) {
	    wp_enqueue_style( 'atmos-engine' );

	if ( ! is_admin() ) {
    	wp_enqueue_style( 'atmos-interactions' );
    }    
}

// add_action( 'wp_enqueue_scripts', 'atmos_load_physics_styles' );

// if ( ! is_admin() ) {
	add_action( 'enqueue_block_assets', 'atmos_load_physics_styles' );
// }

/**
 * ATMOS GRAVITY ENGINE JS: Only on Front-end.
 */
function atmos_load_scripts() {

    $js_uri = get_stylesheet_directory_uri() . '/assets/js/atmos-physics.js';
    $js_path = get_stylesheet_directory() . '/assets/js/atmos-physics.js';

	if ( ! is_admin()	
    	AND file_exists( $js_path ) ) {

		$theme_version = wp_get_theme()->get( 'Version' ) ?? false;			
		wp_enqueue_script( 
			'atmos-physics', 
			$js_uri,
			array('jquery'), 
			$theme_version, 
			$in_footer = true 
		);
	}
}

// Conditionally load javascript that turns cards into links
if ( apply_filters( 'atmos_card_link_js', true ) ) {
	add_action( 'wp_enqueue_scripts', 'atmos_load_scripts' );
}

/**
 * Register Featured Image Block Binding for the Core Image Block
 * Built for Atmos Design Engine
 */
// add_action( 'init', 'record_atmos_featured_image_binding' );
// function record_atmos_featured_image_binding() {
// 	register_block_bindings_source( 'atmos/featured-image', array(
// 		'label'              => __( 'Featured Image (Atmos)', 'atmos' ),
// 		'get_value_callback' => 'atmos_featured_image_binding_callback',
// 	) );
// }
// 
// function atmos_featured_image_binding_callback( $source_args, $block_instance, $attribute_name ) {
// 	// Don't render anything if the post lacks a featured image asset
// 	if ( ! has_post_thumbnail() ) {
// 		return null;
// 	}
// 	
// 	$thumb_id = get_post_thumbnail_id();
// 	
// 	switch ( $attribute_name ) {
// 		case 'url':
// 			return get_the_post_thumbnail_url( null, 'full' );
// 		case 'alt':
// 			return get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
// 		default:
// 			return null;
// 		}
// }