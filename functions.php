<?php
/**
 * File:    functions.php
 * Theme:   Atmos Blocks (Child of Flat Blocks)
 */

/**
 * ATMOS SETUP: Register visual engine and interactions within the Editor Iframe.
 */

// add_action( 'after_setup_theme', 'atmos_blocks_setup' );
// 
// if ( ! function_exists( 'atmos_blocks_setup' ) ) :
//     function atmos_blocks_setup() {
//         // Automatically isolates and parses our CSS files specifically for the Gutenberg editor UI.
//         add_theme_support( 'editor-styles' );
//         add_editor_style( 'assets/css/atmos-engine.css' );
// //         add_editor_style( 'assets/css/atmos-interactions.css' );
//     }
// endif;


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

/**
 * ATMOS GRAVITY ENGINE: Front-End Enqueue ONLY
 */
function atmos_enqueue_gravity_engine() {

	// Get the theme version
	$version = wp_get_theme()->get( 'Version' ) ?? false;
    
    // Get the Atmos Engine css
    $engine_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-engine.css';
    $engine_path = get_stylesheet_directory() . '/assets/css/atmos-engine.css';
    
    $interaction_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-interactions.css';
    $interaction_path = get_stylesheet_directory() . '/assets/css/atmos-interactions.css';

	// Get the CSS build version or use the theme version
	$asset = str_replace( '.css', '.asset.php', $style );

	if ( file_exists ( $asset ) ) {
		$asset_file = include( $asset );
		if ( $asset_file['version'] ) {
			$version = $asset_file['version'];
		}
	}

    // 1. REGISTER handles first to establish the "library"
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
//             array('flat-blocks'),
			array(),            
//             filemtime( $engine_path )
			$asset_version ?? $version;
        );
    }

    if ( file_exists( $interaction_path ) ) {

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
//             filemtime( $engine_path )
			$asset_version ?? $version;
        );
    }

    // 2. ENQUEUE - This actually puts them on the page
    wp_enqueue_style( 'atmos-engine' );

	if ( ! is_admin() ) {
    	wp_enqueue_style( 'atmos-interactions' );
    }
}
// Removed the 'enqueue_block_editor_assets' action to rely strictly on add_editor_style()
// add_action( 'wp_enqueue_scripts', 'atmos_enqueue_gravity_engine', 20 );
// add_action( 'wp_enqueue_scripts', 'atmos_enqueue_gravity_engine' );
add_action( 'enqueue_block_assets', 'atmos_enqueue_gravity_engine' );
