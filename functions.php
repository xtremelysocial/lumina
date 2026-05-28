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

/**
 * Post-Process Core Images: Surgically migrates theme.json borders to <a> wrappers while protecting image sizing layout dimensions.
 */
add_filter( 'render_block_core/image', 'atmos_migrate_image_borders_to_link', 10, 2 );

function atmos_migrate_image_borders_to_link( $block_content, $block ) {
	// 1. Only run if an interactive custom style variation is explicitly active
	if ( empty( $block['attrs']['className'] ) || ! str_contains( $block['attrs']['className'], 'is-style-image-' ) ) {
		return $block_content;
	}

	// 2. DEFENSIVE GATE: If this block isn't a link, it doesn't conflict with our overlay masks.
	// Return immediately to protect unlinked custom patterns and pseudo-icons.
	if ( ! str_contains( $block_content, '<a ' ) ) {
		return $block_content;
	}

	// 3. Initialize the processor to target the inner graphic element
	$processor = new WP_HTML_Tag_Processor( $block_content );
	if ( $processor->next_tag( array( 'tag_name' => 'img' ) ) ) {
		$all_styles_string = $processor->get_attribute( 'style' );

		if ( ! empty( $all_styles_string ) ) {
			// 4. Split the inline rules array to isolate layout geometry vs design traits
			$style_rules = explode( ';', $all_styles_string );
			$img_retained_styles = array();
			$link_migrated_styles = array();

			foreach ( $style_rules as $rule ) {
				$rule = trim( $rule );
				if ( empty( $rule ) ) {
					continue;
				}

				// If the rule explicitly targets borders or clipping paths, flag it for migration
				if ( str_contains( $rule, 'border' ) ) {
					$link_migrated_styles[] = $rule;
				} else {
					// Retain custom width, height, aspect-ratio, and object-fit on the <img> tag
					$img_retained_styles[] = $rule;
				}
			}

			// 5. Re-apply layout bounding metrics to the <img> element
			if ( ! empty( $img_retained_styles ) ) {
				$processor->set_attribute( 'style', implode( '; ', $img_retained_styles ) . ';' );
			} else {
				$processor->remove_attribute( 'style' );
			}
			$block_content = $processor->get_updated_html();

			// 6. Migrate border rules straight to the interactive viewport wrapper
			if ( ! empty( $link_migrated_styles ) ) {
				$link_processor = new WP_HTML_Tag_Processor( $block_content );
				if ( $link_processor->next_tag( array( 'tag_name' => 'a' ) ) ) {
					$existing_link_styles = $link_processor->get_attribute( 'style' );
					$new_link_styles = trim( $existing_link_styles . '; ' . implode( '; ', $link_migrated_styles ), '; ' );
					
					$link_processor->set_attribute( 'style', $new_link_styles . ';' );
					$block_content = $link_processor->get_updated_html();
				}
			}
		}
	}

	return $block_content;
}