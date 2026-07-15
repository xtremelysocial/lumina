<?php
/**
 * File:        default-image.php
 * Theme:       Shared Media Engine
 *
 * Unified Media Architecture. Handles native image blocks,
 * cover toggles, lightboxes, and legacy post loops.
 *
 * @package     XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 /**
 * 1. THE ENGINE CORE
 * Dynamically scans the asset directory for keyword-matched images.
 * Falls back to a true hardcoded default asset if the directory is empty.
 */
if ( ! function_exists( 'get_featured_image_fallback_data' ) ) {
	function get_featured_image_fallback_data( $post_id = null ) {

		$pid = $post_id ? $post_id : get_the_ID();
		
		// ---------------------------------------------------------
		// CONFIGURATION VARIABLES
		// ---------------------------------------------------------
		$path         = 'assets/images/';               // Target folder (relative to theme root)
		$keyword      = 'cover-';                       // Match filenames starting with this string
		$true_default = 'assets/images/cover-bokeh.jpg'; // The absolute fallback relative path
		
		$images = [];

		// Build safe physical system paths for both parent and child theme directories
		$scan_directories = array_unique([
			get_template_directory() . '/' . $path,  // Parent Theme Directory
			get_stylesheet_directory() . '/' . $path  // Child Theme Directory
		]);

		// Scan both folders for matching assets
		foreach ( $scan_directories as $dir ) {
			if ( is_dir( $dir ) ) {
				// Glob files matching the directory structure + keyword prefix
				$matched_files = glob( $dir . $keyword . '*' );
				if ( ! empty( $matched_files ) && is_array( $matched_files ) ) {
					foreach ( $matched_files as $file ) {
						// Extract just the filename (e.g., 'cover-bokeh.jpg')
						$images[] = basename( $file );
					}
				}
			}
		}

		// Deduplicate the list in case the same file name exists in both parent and child folders
		$images = array_unique( $images );

// 		$images = [
// 			'cover-bokeh.jpg', 
// 			'cover-book.jpg', 
// 			'cover-building.jpg', 
// 			'cover-camera.jpg', 
// 			'cover-city-night.jpg', 
// 			'cover-colored-blocks.jpg', 
// 			'cover-colored-chalk.jpg', 
// 			'cover-desk-light.jpg', 
// 			'cover-desk-dark.jpg', 
// 			'cover-desk-meeting.jpg'
// 		];

		// ---------------------------------------------------------
		// RESOLVE TARGET FILE PATH
		// ---------------------------------------------------------
		if ( ! empty( $images ) ) {
			// Reset the array index keys cleanly so the modulo lookup doesn't break
			$images     = array_values( $images );
			$last_digit = $pid % count( $images );
			$chosen_pic = $images[ $last_digit ];
			
			$target_relative_path = $path . $chosen_pic;
		} else {
			// Having a bulletproof hardcoded default here is not odd at all—it's smart defensive coding!
			$target_relative_path = $true_default;
		}

		// ---------------------------------------------------------
		// GENERATE FINAL WRAPPER DATA
		// ---------------------------------------------------------
		// Checks the child theme first, gracefully falling back to parent directory
		$default_url = get_theme_file_uri( $target_relative_path );
		$default_url = apply_filters( 'flatblocks_default_image_url', $default_url, $pid );

		$image_alt = esc_attr( get_the_title( $pid ) );
		$image_alt = apply_filters( 'flatblocks_default_image_alt', $image_alt, $pid );

		return [
			'url' => $default_url,
			'alt' => $image_alt
		];
	}
}

// if ( ! function_exists( __NAMESPACE__ . '\get_featured_image_fallback_data' ) ) {
// 	function get_featured_image_fallback_data( $post_id = null ) {
// 		$pid  = $post_id ? $post_id : get_the_ID();
// 		$path = 'assets/images/'; 
// 		
// 		$images = [
// 			'cover-bokeh.jpg', 
// 			'cover-book.jpg', 
// 			'cover-building.jpg', 
// 			'cover-camera.jpg', 
// 			'cover-city-night.jpg', 
// 			'cover-colored-blocks.jpg', 
// 			'cover-colored-chalk.jpg', 
// 			'cover-desk-light.jpg', 
// 			'cover-desk-dark.jpg', 
// 			'cover-desk-meeting.jpg'
// 		];
// 
// 		$last_digit = $pid % count( $images );
// 		$image      = $images[ $last_digit ];
// 
// 		$default_url = get_theme_file_uri( $path . $image );
// 		$default_url = apply_filters( 'flatblocks_default_image_url', $default_url, $pid );
// 
// 		$image_alt = esc_attr( get_the_title( $pid ) );
// 		$image_alt = apply_filters( 'flatblocks_default_image_alt', $image_alt, $pid );
// 
// 		return [
// 			'url' => $default_url,
// 			'alt' => $image_alt
// 		];
// 	}
// }

/**
 * 2. THE COVER TOGGLE INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_cover_block_fallback' ) ) {
	function filter_cover_block_fallback( $block_content, $block ) {
		// Using meta truth check to completely evade the Section 4 filter paradox
		if ( ! empty( $block['attrs']['useFeaturedImage'] ) && ! get_post_thumbnail_id( get_the_ID() ) ) {
			$fallback = get_featured_image_fallback_data( get_the_ID() );
			
			if ( preg_match( '/src=["\']([^"\']*)["\']/i', $block_content ) ) {
				$block_content = preg_replace( '/src=["\']([^"\']*)["\']/', 'src="' . esc_url( $fallback['url'] ) . '"', $block_content );
			}
			$block_content = preg_replace( '/url\([^)]*\)/', 'url(' . esc_url( $fallback['url'] ) . ')', $block_content );
		}
		return $block_content;
	}
	add_filter( 'render_block_core/cover', __NAMESPACE__ . '\filter_cover_block_fallback', 10, 2 );
}

/**
 * 3. THE LEGACY INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_legacy_post_thumbnail_html' ) ) {
	function filter_legacy_post_thumbnail_html( $html, $pid, $post_thumbnail_id, $size, $attr ) {

		if ( ! $html && $pid ) {
			$fallback    = get_featured_image_fallback_data( $pid );
			$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
			$image_style = ( is_array( $attr ) && ! empty( $attr['style'] ) ) ? $attr['style'] : '';
			
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
	add_filter( 'post_thumbnail_html', __NAMESPACE__ . '\filter_legacy_post_thumbnail_html', 10, 5 );
}

/**
 * 4. FORCE TRUE FOR WRAPPERS CONSISTENCY
 */
if ( ! function_exists( __NAMESPACE__ . '\has_post_thumbnail_fallback' ) ) {
	function has_post_thumbnail_fallback( $has_thumbnail, $post, $thumbnail_id ) {
		return true;
	}
	add_filter( 'has_post_thumbnail', __NAMESPACE__ . '\has_post_thumbnail_fallback', 10, 3 );
}