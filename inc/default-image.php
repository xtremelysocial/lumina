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
 * Dynamically scans Lumina's asset directory for fallback images.
 */
if ( ! function_exists( __NAMESPACE__ . '\get_featured_image_fallback_data' ) ) {
	function get_featured_image_fallback_data( $post_id = null ) {

		$pid = $post_id ? $post_id : get_the_ID();
		
		// ---------------------------------------------------------
		// CONFIGURATION & THEME.JSON DYNAMIC RESOLUTION
		// ---------------------------------------------------------
		$base_path        = 'assets/images/';

		$keyword          = ''; // Optional filename prefix (e.g., 'sage-' or '')

		$exclude_dirs     = [ 	// Subfolder names to skip
			'samples'
		]; 

		$exclude_prefixes = [   // Filename prefixes to skip
		]; 
		
		$allowed_extensions = [ 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' ];

		// Set a true default image path that actually exists in Lumina
		$true_default       = 'assets/images/paper/paper-01.webp';

		// 1. Fetch Global Settings from theme.json
		$global_settings = function_exists( 'wp_get_global_settings' ) ? wp_get_global_settings() : [];
		$theme_custom    = $global_settings['custom']['color']['theme'] ?? [];

		$target_folders = [];

		// Check for Array / String keys: 'image-folders', 'image-folder', 'images'
		foreach ( [ 'image-folders', 'image-folder', 'images' ] as $key ) {
			if ( ! empty( $theme_custom[ $key ] ) ) {
				$val = $theme_custom[ $key ];
				if ( is_array( $val ) ) {
					$target_folders = array_merge( $target_folders, $val );
				} elseif ( is_string( $val ) ) {
					$target_folders[] = $val;
				}
			}
		}

		// Check for Numbered Keys: 'image-folder-01', 'image-folder-02', etc.
		foreach ( $theme_custom as $key => $val ) {
			if ( preg_match( '/^image[-_]folder[-_]?\d+$/i', $key ) && ! empty( $val ) ) {
				if ( is_array( $val ) ) {
					$target_folders = array_merge( $target_folders, $val );
				} elseif ( is_string( $val ) ) {
					$target_folders[] = $val;
				}
			}
		}

		$target_folders = array_filter( array_unique( $target_folders ) );

		// Fallback to 'scheme' if no explicit image folders were configured
		if ( empty( $target_folders ) && ! empty( $theme_custom['scheme'] ) ) {
			$target_folders[] = $theme_custom['scheme'];
		}

		// ---------------------------------------------------------
		// DIRECTORY SCANNING ENGINE (STRICTLY LUMINA / CHILD THEME)
		// ---------------------------------------------------------
		$child_theme_root = wp_normalize_path( get_stylesheet_directory() );
		$full_base_path   = trailingslashit( $child_theme_root ) . $base_path;
		$paths_to_scan    = [];

		// 1. Scan specified target folders
		if ( ! empty( $target_folders ) ) {
			foreach ( $target_folders as $folder ) {
				$folder_path = trailingslashit( $full_base_path ) . trim( $folder, '/' ) . '/';
				if ( is_dir( $folder_path ) ) {
					$paths_to_scan[] = $folder_path;
				}
			}
		}

		// 2. Auto-Discovery Fallback: If no target folders matched, scan ALL subfolders in Lumina assets/images/
		// (Root /assets/images/ is excluded so pattern/static assets are never used as featured fallbacks)
		if ( empty( $paths_to_scan ) && is_dir( $full_base_path ) ) {
			$subdirs = glob( trailingslashit( $full_base_path ) . '*', GLOB_ONLYDIR );
			if ( ! empty( $subdirs ) ) {
				foreach ( $subdirs as $subdir ) {
					$folder_name = basename( $subdir );
					if ( ! in_array( $folder_name, $exclude_dirs, true ) ) {
						$paths_to_scan[] = trailingslashit( $subdir );
					}
				}
			}
		}

		$images = [];

		// Perform scan across resolved subdirectories
		foreach ( $paths_to_scan as $scan_path ) {
			$search_pattern = trailingslashit( $scan_path ) . $keyword . '*.{jpg,jpeg,png,gif,webp,svg}';
			$matched_files  = glob( $search_pattern, GLOB_BRACE );

			if ( ! empty( $matched_files ) && is_array( $matched_files ) ) {
				foreach ( $matched_files as $file ) {
					if ( is_file( $file ) ) {
						$filename       = basename( $file );
						$should_exclude = false;

						foreach ( $exclude_prefixes as $prefix ) {
							if ( ! empty( $prefix ) && strpos( $filename, $prefix ) === 0 ) {
								$should_exclude = true;
								break;
							}
						}

						if ( ! $should_exclude ) {
							$normalized_file = wp_normalize_path( $file );
							$images[]        = ltrim( str_replace( $child_theme_root, '', $normalized_file ), '/' );
						}
					}
				}
			}
		}

		$images = array_values( array_unique( $images ) );

		// ---------------------------------------------------------
		// RESOLVE TARGET FILE PATH
		// ---------------------------------------------------------
		if ( ! empty( $images ) ) {
			$hash_seed            = 'lumina_' . $pid;
			$hashed_val           = abs( crc32( $hash_seed ) );
			$last_digit           = $hashed_val % count( $images );
			$target_relative_path = $images[ $last_digit ];
		} else {
			$target_relative_path = $true_default;
		}

		// ---------------------------------------------------------
		// GENERATE FINAL WRAPPER DATA (FORCED TO CHILD THEME URI)
		// ---------------------------------------------------------
		$default_url = get_stylesheet_directory_uri() . '/' . $target_relative_path;
		$default_url = apply_filters( 'flatblocks_default_image_url', $default_url, $pid );

		$image_alt = esc_attr( get_the_title( $pid ) );
		$image_alt = apply_filters( 'flatblocks_default_image_alt', $image_alt, $pid );

		return [
			'url' => $default_url,
			'alt' => $image_alt
		];
	}
}

/**
 * 2. THE COVER TOGGLE INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_cover_block_fallback' ) ) {
	function filter_cover_block_fallback( $block_content, $block ) {
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

		// Only intercept and inject a fallback image if no real thumbnail exists
// 		if ( ! $html && $pid ) {
			$fallback    = get_featured_image_fallback_data( $pid );
			$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
			
			// Preserve block classes passed by WordPress (e.g. has-highlight-border-color)
			if ( is_array( $attr ) && ! empty( $attr['class'] ) ) {
				$image_class .= ' ' . $attr['class'];
			}

			$image_style = ( is_array( $attr ) && ! empty( $attr['style'] ) ) ? $attr['style'] : '';
			
			preg_match( "/max-width:(\\d+).*max-height:(\\d+)/", $image_style, $dimensions );
			
			$image_dimensions = $dimensions ? sprintf( 'width="%d" height="%d"', $dimensions[1], $dimensions[2] ) : '';
			$image_style     .= $dimensions ? sprintf( 'width:%dpx;height:%dpx;', $dimensions[1], $dimensions[2] ) : '';
			
			$html = sprintf(
				'<img loading="lazy" decoding="async" src="%s" alt="%s" class="%s" style="%s" %s />',
				esc_url( $fallback['url'] ),
				esc_attr( $fallback['alt'] ),
				esc_attr( trim( $image_class ) ),
				esc_attr( $image_style ),
				$image_dimensions
			);
// 		}

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