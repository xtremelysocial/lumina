<?php
/**
 * File:        default-image.php
 * Theme:       Lumina Blocks
 *
 * Unified Media Architecture for Lumina. Handles native image blocks,
 * block bindings, cover toggles, lightboxes, and legacy post loops.
 *
 * @package     lumina
 */

/**
 * 1. THE ENGINE CORE
 * Generates a consistent, pseudo-random layout asset based on Post ID.
 */
function lumina_get_featured_image_fallback_data( $post_id = null ) {
	$pid  = $post_id ? $post_id : get_the_ID();
	$path = 'assets/images/';
	
	$images = [
		'cover-bokeh.jpg', 
		'cover-book.jpg', 
		'cover-building.jpg', 
		'cover-camera.jpg', 
		'cover-city-night.jpg', 
		'cover-colored-blocks.jpg', 
		'cover-colored-chalk.jpg', 
		'cover-desk-light.jpg', 
		'cover-desk-dark.jpg', 
		'cover-desk-meeting.jpg'
	];

	$last_digit = $pid % count( $images );
	$image      = $images[ $last_digit ];

	$default_url = get_theme_file_uri( $path . $image );
	$default_url = apply_filters( 'flatblocks_default_image_url', $default_url, $pid );

	$image_alt = esc_attr( get_the_title( $pid ) );
	$image_alt = apply_filters( 'flatblocks_default_image_alt', $image_alt, $pid );

	return [
		'url' => $default_url,
		'alt' => $image_alt
	];
}

/**
 * 2. THE MODERN INTERCEPT: Block Bindings API
 */
// add_action( 'init', 'register_lumina_featured_image_binding' );
// function register_lumina_featured_image_binding() {
// 	register_block_bindings_source( 'lumina/featured-image', [
// 		'label'              => __( 'Featured Image (Lumina)', 'lumina' ),
// 		'uses_context'       => [ 'postId' ],
// 		'get_value_callback' => 'lumina_featured_image_binding_callback',
// 	] );
// }

// function lumina_featured_image_binding_callback( $source_args, $block_instance, $attribute_name ) {
// 	$post_id = isset( $block_instance->context['postId'] ) ? $block_instance->context['postId'] : get_the_ID();
// 	if ( ! $post_id ) {
// 		return null;
// 	}
// 
// 	$thumb_id = get_post_thumbnail_id( $post_id );
// 	if ( $thumb_id ) {
// 		switch ( $attribute_name ) {
// 			case 'url':
// 				return get_the_post_thumbnail_url( $post_id, 'full' );
// 			case 'alt':
// 				return get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
// 			default:
// 				return null;
// 		}
// 	}
// 
// 	$fallback = lumina_get_featured_image_fallback_data( $post_id );
// 	return isset( $fallback[ $attribute_name ] ) ? $fallback[ $attribute_name ] : null;
// }

/**
 * JS BRIDGE: Registers the binding source properly in Gutenberg.
 */
// add_action( 'enqueue_block_editor_assets', 'lumina_register_editor_block_bindings_bridge' );
// function lumina_register_editor_block_bindings_bridge() {
// 	$js_code = "
// 		window.addEventListener('DOMContentLoaded', function() {
// 			if ( window.wp && window.wp.blocks && window.wp.blocks.registerBlockBindingsSource ) {
// 				window.wp.blocks.registerBlockBindingsSource({
// 					name: 'lumina/featured-image',
// 					label: 'Featured Image (Lumina)',
// 					getValues: function() {
// 						return {
// 							url: 'data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"100\" height=\"40\" viewBox=\"0 0 100 40\"><rect width=\"100%\" height=\"100%\" fill=\"%232c3539\"/><text x=\"50%\" y=\"50%\" dominant-baseline=\"middle\" text-anchor=\"middle\" fill=\"%23fff\" font-family=\"sans-serif\" font-size=\"6\">Lumina Binding Preview</text></svg>',
// 							alt: 'Featured Image'
// 						};
// 					}
// 				});
// 			}
// 		});
// 	";
// 	wp_add_inline_script( 'wp-blocks', $js_code );
// }

/**
 * 3. THE NATIVE LIGHTBOX ENABLER
 * Dynamically injects the real attachment ID into bound image blocks before rendering.
 */
// add_filter( 'render_block_data', 'lumina_inject_featured_image_id_to_block', 10, 2 );
// function lumina_inject_featured_image_id_to_block( $block, $parsed_block ) {
// 	if ( isset( $block['blockName'] ) && 'core/image' === $block['blockName'] ) {
// 		if ( isset( $block['attrs']['metadata']['bindings']['url']['source'] ) && $block['attrs']['metadata']['bindings']['url']['source'] === 'lumina/featured-image' ) {
// 			$post_id = get_the_ID();
// 			if ( $post_id ) {
// 				$thumb_id = get_post_thumbnail_id( $post_id );
// 				if ( $thumb_id ) {
// 					$block['attrs']['id'] = $thumb_id;
// 				}
// 			}
// 		}
// 	}
// 	return $block;
// }

/**
 * 4. THE LAYOUT CLASS INJECTION
 * Inject a custom style hook class into bound images so we can crop them safely via CSS.
 */
// add_filter( 'render_block_core/image', 'lumina_force_dimensions_on_bound_image', 20, 2 );
// function lumina_force_dimensions_on_bound_image( $block_content, $block ) {
// 	if ( isset( $block['attrs']['metadata']['bindings']['url']['source'] ) && $block['attrs']['metadata']['bindings']['url']['source'] === 'lumina/featured-image' ) {
// 		
// 		// Injects our target selector class onto the opening block element
// 		$block_content = preg_replace( '/class=["\']/', '$0is-pano-banner ', $block_content, 1 );
// 	}
// 	return $block_content;
// }

/**
 * 5. THE COVER TOGGLE INTERCEPT
 */
add_filter( 'render_block_core/cover', 'lumina_filter_cover_block_fallback', 10, 2 );
function lumina_filter_cover_block_fallback( $block_content, $block ) {
	if ( ! empty( $block['attrs']['useFeaturedImage'] ) && ! has_post_thumbnail( get_the_ID() ) ) {
		$fallback = lumina_get_featured_image_fallback_data( get_the_ID() );
		
		if ( preg_match( '/src=["\']([^"\']*)["\']/i', $block_content ) ) {
			$block_content = preg_replace( '/src=["\']([^"\']*)["\']/', 'src="' . esc_url( $fallback['url'] ) . '"', $block_content );
		}
		$block_content = preg_replace( '/url\([^)]*\)/', 'url(' . esc_url( $fallback['url'] ) . ')', $block_content );
	}
	return $block_content;
}

/**
 * 6. THE LEGACY INTERCEPT
 * Intercepts missing post thumbnails and injects uniform theme placeholders 
 * leveraging dynamic regex dimension matching and utility helper mapping.
 */
add_filter( 'post_thumbnail_html', 'lumina_filter_legacy_post_thumbnail_html', 10, 5 );

if ( ! function_exists( 'lumina_filter_legacy_post_thumbnail_html' ) ) :

	function lumina_filter_legacy_post_thumbnail_html( $html, $pid, $post_thumbnail_id, $size, $attr ) {

		/* If no post featured image, but there is a post, then set the default image */
		if ( ! $html && $pid ) {
			
			// Pull path and alt data out of our unified fallback data engine
			$fallback = lumina_get_featured_image_fallback_data( $pid );
			
			$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
			
			// Safely read the incoming block style string if it exists
			$image_style = ( is_array( $attr ) && ! empty( $attr['style'] ) ) ? $attr['style'] : '';
			
			// Execute your original pattern match against the inline layout constraints
			preg_match( "/max-width:(\\d+).*max-height:(\\d+)/", $image_style, $dimensions );
			
			$image_dimensions = $dimensions ? sprintf( 'width="%d" height="%d"', $dimensions[1], $dimensions[2] ) : '';
			$image_style     .= $dimensions ? sprintf( 'width:%dpx;height:%dpx;', $dimensions[1], $dimensions[2] ) : '';
			
			$html = sprintf(
				'<img loading="lazy" decoding="async" src="%s" alt="%s" class="%s" style="%s" %s />',
				esc_url( $fallback['url'] ),
				esc_attr( $fallback['alt'] ),
				esc_attr( $image_class ),
				esc_attr( $image_style ),
				$image_dimensions
			);
		}

		return $html;
	}

endif;

/**
 * Force has_post_thumbnail to return true for fallback consistency.
 * This ensures blocks (like Latest Posts and Query Loops) write the image wrappers
 * for posts that don't have user-uploaded media.
 */
add_filter( 'has_post_thumbnail', 'lumina_has_post_thumbnail_fallback', 10, 3 );
if ( ! function_exists( 'lumina_has_post_thumbnail_fallback' ) ) :
	function lumina_has_post_thumbnail_fallback( $has_thumbnail, $post, $thumbnail_id ) {
		return true;
	}
endif;

/**
 * 6. THE LEGACY INTERCEPT
 * Intercepts missing post thumbnails and injects uniform theme placeholders 
 * with correct architectural dimensions and lazy-loading support.
 */
// add_filter( 'post_thumbnail_html', 'lumina_filter_legacy_post_thumbnail_html', 10, 5 );
// 
// function lumina_filter_legacy_post_thumbnail_html( $html, $pid, $post_thumbnail_id, $size, $attr ) {
// 	if ( ! $html && $pid ) {
// 		$fallback = lumina_get_featured_image_fallback_data( $pid );
// 		
// 		$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
// 		$image_style = isset( $attr['style'] ) ? esc_attr( $attr['style'] ) : '';
// 
// 		// Dynamic size calculation definitions
// 		$width  = '';
// 		$height = '';
// 
// 		// A. Check if standard core sizes or custom theme sizes are passed as a string
// 		if ( is_string( $size ) ) {
// 			if ( in_array( $size, [ 'thumbnail', 'medium', 'large' ], true ) ) {
// 				$width  = get_option( "{$size}_size_w" );
// 				$height = get_option( "{$size}_size_h" );
// 			} else {
// 				global $_wp_additional_image_sizes;
// 				if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
// 					$width  = $_wp_additional_image_sizes[ $size ]['width'];
// 					$height = $_wp_additional_image_sizes[ $size ]['height'];
// 				}
// 			}
// 		// B. Handle raw layout coordinates passed as an array
// 		} elseif ( is_array( $size ) ) {
// 			$width  = isset( $size[0] ) ? $size[0] : '';
// 			$height = isset( $size[1] ) ? $size[1] : '';
// 		}
// 
// 		// C. Fallback to inline style parsing if option matches drew blank parameters
// 		if ( ( ! $width || ! $height ) && ! empty( $attr['style'] ) && preg_match( "/max-width:(\\d+).*max-height:(\\d+)/", $attr['style'], $dimensions ) ) {
// 			$width  = $dimensions[1];
// 			$height = $dimensions[2];
// 			$image_style .= sprintf( 'width:%dpx;height:%dpx;', $width, $height );
// 		}
// 
// 		// Format output parameters cleanly
// 		$dimension_attrs = ( $width && $height ) ? sprintf( 'width="%s" height="%s"', esc_attr( $width ), esc_attr( $height ) ) : '';
// 		$loading_attr    = 'loading="lazy"';
// 
// 		$html = sprintf(
// 			'<img %s decoding="async" src="%s" alt="%s" class="%s" style="%s" %s />',
// 			$loading_attr,
// 			esc_url( $fallback['url'] ),
// 			esc_attr( $fallback['alt'] ),
// 			esc_attr( $image_class ),
// 			esc_attr( $image_style ),
// 			$dimension_attrs
// 		);
// 	}
// 	return $html;
// }

/**
 * 6. THE LEGACY INTERCEPT
 */
// add_filter( 'post_thumbnail_html', 'lumina_filter_legacy_post_thumbnail_html', 10, 5 );
// function lumina_filter_legacy_post_thumbnail_html( $html, $pid, $post_thumbnail_id, $size, $attr ) {
// 	if ( ! $html && $pid ) {
// 		$fallback = lumina_get_featured_image_fallback_data( $pid );
// 		
// 		$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
// 		$image_style = isset( $attr['style'] ) ? esc_attr( $attr['style'] ) : '';
// 
// 		$image_dimensions = '';
// 		if ( ! empty( $attr['style'] ) && preg_match( "/max-width:(\\d+).*max-height:(\\d+)/", $attr['style'], $dimensions ) ) {
// 			$image_dimensions = sprintf( 'width="%d" height="%d"', $dimensions[1], $dimensions[2] );
// 			$image_style     .= sprintf( 'width:%dpx;height:%dpx;', $dimensions[1], $dimensions[2] );
// 		}
// 
// 		$html = sprintf(
// 			'<img src="%s" alt="%s" class="%s" style="%s" %s />',
// 			esc_url( $fallback['url'] ),
// 			esc_attr( $fallback['alt'] ),
// 			esc_attr( $image_class ),
// 			esc_attr( $image_style ),
// 			$image_dimensions
// 		);
// 	}
// 	return $html;
// }
// 
// add_filter( 'has_post_thumbnail', '__return_true', 10 );

/*
 * Requires this as CSS too
 */
 /*
 // Lumina Panoramic Banner Crop Rules
figure.is-pano-banner {
    height: 309px !important;
    overflow: hidden !important;
    display: flex !important;
    align-items: center !important; 
	border-radius: var(--wp--preset--border-radius--sm) !important;
}

figure.is-pano-banner img {
    width: 100% !important;
    height: auto !important;
    max-width: 100% !important;
    display: block !important;
}
 */
 