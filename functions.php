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

if ( ! function_exists( 'atmosblocks_support' ) ) :

	function atmosblocks_support() {

		// Enqueue the styles needed for the editor. Do this here to 
		// avoid interfering with the Editor UI. 
		$editor_styles = array(
			'/assets/css/atmos-theme.css',
			'/assets/css/atmos-engine.css',
// 			'/assets/css/editor-styles.css',
		);

		// Load the editor styles
		add_editor_style( $editor_styles ); 		
	}
endif;

add_action( 'after_setup_theme', 'atmosblocks_support' );

/**
 * ATMOS THEME CSS
 */
function atmos_load_styles() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;

	// Set the CSS path and URI
    $css_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-theme.css';
    $css_path = get_stylesheet_directory() . '/assets/css/atmos-theme.css';

    // 1. REGISTER handles for CSS first to establish the "library"
    
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

add_action( 'wp_enqueue_scripts', 'atmos_load_styles' );

/**
 * ATMOS GRAVITY ENGINE CSS: Only on the Front-end.
 * Engine is loaded in the Editor above via add_editor_styles(). 
 */
function atmos_enqueue_gravity_engine() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;
    
    // Get the Atmos Engine css
    $engine_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-engine.css';
    $engine_path = get_stylesheet_directory() . '/assets/css/atmos-engine.css';
    
    $interaction_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-interactions.css';
    $interaction_path = get_stylesheet_directory() . '/assets/css/atmos-interactions.css';

    // 1. REGISTER handles for CSS first to establish the "library"
    
    // Atmos Engine Resting State CSS
	if ( ! is_admin()	
    	AND file_exists( $engine_path ) ) {

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
	if ( ! is_admin() ) {
	    wp_enqueue_style( 'atmos-engine' );

    	wp_enqueue_style( 'atmos-interactions' );
    }    
}

if ( ! is_admin() ) {
	add_action( 'enqueue_block_assets', 'atmos_enqueue_gravity_engine' );
}

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

add_action( 'wp_enqueue_scripts', 'atmos_load_scripts' );

