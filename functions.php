<?php
/**
 * Atmos Blocks functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package atmos-blocks
 * @since 1.0.0
 */

if ( ! function_exists( 'atmos_blocks_setup' ) ) :
	function atmos_blocks_setup() {

		/**
		 * Enable support for Editor Styles.
		 */
		add_theme_support( 'editor-styles' );

		/**
		 * Enqueue Editor Styles.
		 * By only loading style.css, the Site Editor remains static 
		 * and performant while you build.
		 */
		add_editor_style( 'style.css' );

		// Register Atmos Pattern Category
		register_block_pattern_category(
			'atmos',
			array( 'label' => __( 'Atmos', 'atmos-blocks' ) )
		);

		/**
		 * Style: No Rounding
		 * Neutralizes the theme.json 16px radius for sharp, tactical edges.
		 */
		register_block_style(
			array( 'core/group', 'core/columns', 'core/column', 'core/image', 'core/post-featured-image', 'core/media-text', 'core/cover' ),
			array(
				'name'  => 'no-rounding',
				'label' => __( 'No Rounding', 'atmos-blocks' ),
			)
		);

		/**
		 * Style: Tactile Shadow
		 * Applies the 'Natural' ambient shadow to containerized objects.
		 */
		register_block_style(
			array( 'core/group', 'core/columns', 'core/column', 'core/media-text', 'core/cover' ),
			array(
				'name'  => 'shadow',
				'label' => __( 'Tactile Shadow', 'atmos-blocks' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'atmos_blocks_setup' );

/**
 * Enqueue Child Theme Styles
 * Front-end only gets the 'Physics' layer to prevent editor jitter.
 */
function atmos_blocks_enqueue_styles() {
	// 1. Load the Main Identity Style (Colors, Typography, Layout)
	wp_enqueue_style( 
		'atmos-blocks-style', 
		get_stylesheet_uri(), 
		array( 'flat-blocks' ), 
		wp_get_theme()->get( 'Version' ) 
	);

	// 2. Load Physics Style (Animations, Hover Scales, Transitions)
	// This is excluded from the editor via add_editor_style above.
	wp_enqueue_style( 
		'atmos-physics', 
		get_theme_file_uri( 'physics.css' ), 
		array( 'atmos-blocks-style' ), 
		wp_get_theme()->get( 'Version' ) 
	);
}
add_action( 'wp_enqueue_scripts', 'atmos_blocks_enqueue_styles' );

/**
 * Forcefully remove Flat Blocks color variations and duplicate child styles.
 * This targets the 'User' data level which often overrides the 'Theme' level filters.
 */
function atmos_clean_editor_variations( $theme_json ) {
    $data = $theme_json->get_data();

    if ( ! empty( $data['styles']['variations'] ) ) {
        foreach ( $data['styles']['variations'] as $key => $variation ) {
            
            // 1. Kill everything from the Flat Blocks colors folder
            if ( isset( $variation['path'] ) && strpos( $variation['path'], 'flat-blocks/styles/colors' ) !== false ) {
                unset( $data['styles']['variations'][$key] );
                continue;
            }

            // 2. Kill the duplicate "Atmos Elements" appearing at the end
            // Usually occurs if the root theme.json is being indexed as a variation
            if ( isset( $variation['title'] ) && $variation['title'] === 'Atmos Elements' ) {
                unset( $data['styles']['variations'][$key] );
            }
        }

        // Re-index and push back to the object
        $data['styles']['variations'] = array_values( $data['styles']['variations'] );
        $theme_json->update_with( $data );
    }

    return $theme_json;
}
add_filter( 'wp_theme_json_data_user', 'atmos_clean_editor_variations', 99 );

/**
 * Surgically remove Flat Blocks color variations from the theme data.
 * Keeps structural styles and Atmos variations.
 */
/* 
function atmos_strip_parent_color_variations( $theme_json ) {
    $data = $theme_json->get_data();

    // Check if there are style variations registered
    if ( ! empty( $data['styles']['variations'] ) ) {
        foreach ( $data['styles']['variations'] as $key => $variation ) {
            // Target variations that live in the parent theme's 'styles/colors' directory
            // This is the most accurate way to find exactly what you want to kill
            if ( isset( $variation['path'] ) && strpos( $variation['path'], 'flat-blocks/styles/colors' ) !== false ) {
                unset( $data['styles']['variations'][$key] );
            }
        }
        
        // Re-index the array and update the object
        $data['styles']['variations'] = array_values( $data['styles']['variations'] );
        $theme_json->update_with( $data );
    }

    return $theme_json;
}
add_filter( 'wp_theme_json_data_theme', 'atmos_strip_parent_color_variations' );
 */

/**
 * Remove Flat Blocks color scheme variations from the Site Editor.
 * This runs as soon as functions.php is loaded.
 */
/* 
add_filter( 'theme_file_path', 'atmos_exclude_flat_blocks_colors', 10, 2 );

function atmos_exclude_flat_blocks_colors( $path, $file ) {
    // We only care about style variation requests
    if ( strpos( $file, 'styles/colors' ) !== false && is_child_theme() ) {
        
        // Check if the path belongs to the parent theme (Flat Blocks)
        if ( strpos( $path, get_template_directory() ) !== false ) {
            return ''; // Hide it
        }
    }

    return $path;
}
 */