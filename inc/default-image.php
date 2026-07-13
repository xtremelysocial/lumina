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
 * 2. THE COVER TOGGLE INTERCEPT
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
 * 3. THE LEGACY INTERCEPT
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
 * 4. Force has_post_thumbnail to return true for fallback consistency.
 * This ensures blocks (like Latest Posts and Query Loops) write the image wrappers
 * for posts that don't have user-uploaded media.
 */
add_filter( 'has_post_thumbnail', 'lumina_has_post_thumbnail_fallback', 10, 3 );
if ( ! function_exists( 'lumina_has_post_thumbnail_fallback' ) ) :
	function lumina_has_post_thumbnail_fallback( $has_thumbnail, $post, $thumbnail_id ) {
		return true;
	}
endif;
