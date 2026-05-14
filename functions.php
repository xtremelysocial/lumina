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
 * ATMOS GRAVITY ENGINE: Front-End Enqueue ONLY
 */
function atmos_enqueue_gravity_engine() {
    
    $engine_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-engine.css';
    $engine_path = get_stylesheet_directory() . '/assets/css/atmos-engine.css';
    
    $interaction_uri = get_stylesheet_directory_uri() . '/assets/css/atmos-interactions.css';
    $interaction_path = get_stylesheet_directory() . '/assets/css/atmos-interactions.css';

    // 1. REGISTER handles first to establish the "library"
    if ( file_exists( $engine_path ) ) {
//     	echo "registering atmos-engine"; //TEST
        wp_register_style(
            'atmos-engine',
            $engine_uri,
//             array('flat-blocks'),
			array(),            
            filemtime( $engine_path )
        );
    }

    if ( file_exists( $interaction_path ) ) {
//     	echo "registering atmos-interactions"; //TEST    
        wp_register_style(
            'atmos-interactions',
            $interaction_uri,
            array('atmos-engine'), 
//             array(),
            filemtime( $interaction_path )
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
