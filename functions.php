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
	'/inc/default-image.php',
	'/inc/add-body-classes.php',
// 	'/inc/category-colors.php',
// 	'/inc/ image-move-border.php',	
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

/**
 * Lumina Engine Extensions
 */

add_filter( 'get_block_templates', 'lumina_unload_parent_template_parts', 10, 3 );
/**
 * Intercepts the block editor template discovery engine and unloads legacy file-based
 * template parts inherited from the parent theme by validating local file existence.
 */
function lumina_unload_parent_template_parts( $query_result, $query, $template_type ) {
	// Only apply the filter when WordPress is gathering Template Parts
	if ( 'wp_template_part' !== $template_type ) {
		return $query_result;
	}

	// Anchor to Lumina's local template parts path
	$child_parts_dir = get_stylesheet_directory() . '/parts/';

	$filtered_parts = array_filter( $query_result, function( $template_part ) use ( $child_parts_dir ) {
		// Identify if the template part is a raw file-based theme asset
		if ( isset( $template_part->source ) && 'theme' === $template_part->source ) {
			// Construct the exact filename layout WordPress looks for
			$local_file = $child_parts_dir . $template_part->slug . '.html';

			// If the file does not exist inside Lumina, it's an inherited parent file—drop it!
			if ( ! file_exists( $local_file ) ) {
				return false;
			}
		}
		return true;
	});

	// Re-index the array values cleanly to protect the REST API collection loop
	return array_values( $filtered_parts );
}

// add_filter( 'get_block_templates', 'lumina_unload_parent_template_parts', 10, 3 );
/**
 * Intercepts the block editor template discovery engine and safely unloads
 * all legacy file-based template parts inherited from the parent theme.
 */
// function lumina_unload_parent_template_parts( $query_result, $query, $template_type ) {
// 	// Only apply the filter when WordPress is gathering Template Parts
// 	if ( 'wp_template_part' !== $template_type ) {
// 		return $query_result;
// 	}
// 
// 	// Filter out any template parts originating from the 'flat-blocks' folder namespace
// 	return array_filter( $query_result, function( $template_part ) {
// 		return 'flat-blocks' !== $template_part->theme;
// 	});
// }

/* Remove the parent's theme HTML patterns (no way to remove the PHP ones) */
add_filter('flatblocks_block_patterns', 'flatblocks_pro_block_patterns' );

function flatblocks_pro_block_patterns( $block_patterns ) {

	$pro_patterns = array();
	
	return  $pro_patterns;	
}

/**
 * Register Featured Image Block Binding for the Core Image Block
 * Built for Lumina Design Engine
 */
// add_action( 'init', 'record_lumina_featured_image_binding' );
// function record_lumina_featured_image_binding() {
// 	register_block_bindings_source( 'lumina/featured-image', array(
// 		'label'              => __( 'Featured Image (Lumina)', 'lumina' ),
// 		'get_value_callback' => 'lumina_featured_image_binding_callback',
// 	) );
// }
// 
// function lumina_featured_image_binding_callback( $source_args, $block_instance, $attribute_name ) {
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