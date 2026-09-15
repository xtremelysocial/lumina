<?php
/**
 * File:        images.php
 * Theme:       Shared Media Functions
 *
 * Unified Media Architecture. Handles native image blocks,
 * cover toggles, media-text toggles, lightboxes, and legacy post loops.
 *
 * @package     XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TEST & OVERRIDE CONFIGURATION
 * Set to true to force default fallback images across ALL posts for testing.
 * Set to false for normal production operation.
 */
if ( ! defined( 'FORCE_DEFAULT_IMAGE' ) ) {
	define( 'FORCE_DEFAULT_IMAGE', true ); // Set to false for production
}

/**
 * 1. THE ENGINE CORE
 * Dynamically scans Lumina's asset directory for fallback images.
 */
if ( ! function_exists( __NAMESPACE__ . '\get_featured_image_fallback_data' ) ) {
	function get_featured_image_fallback_data( $post_id = null ) {

		$pid = $post_id ? $post_id : get_the_ID();
		
		$base_path        = 'assets/images/';

		$exclude_dirs     = [
			'about',
			'pages',
			'screenshots',
			'team',
			'testimonials'
		]; 

		$exclude_prefixes = []; 
		
		$allowed_extensions = [ 'jpg', 'jpeg', 'png', 'gif', 'webp' ];

		$true_default       = 'assets/images/samples/01.webp';

		$global_settings = function_exists( 'wp_get_global_settings' ) ? wp_get_global_settings() : [];
		$custom_settings = $global_settings['custom'] ?? [];
		$theme_custom    = $custom_settings['color']['theme'] ?? [];

		$target_folders = [];

		foreach ( [ 'image-folders', 'image-folder', 'images', 'imageFolders', 'imageFolder' ] as $key ) {
			if ( ! empty( $theme_custom[ $key ] ) ) {
				$val = $theme_custom[ $key ];
				if ( is_array( $val ) ) {
					$target_folders = array_merge( $target_folders, $val );
				} elseif ( is_string( $val ) ) {
					$target_folders[] = $val;
				}
			}
		}

		foreach ( $theme_custom as $key => $val ) {
			if ( preg_match( '/^image[-_]?folder[-_]?\d+$/i', $key ) && ! empty( $val ) ) {
				if ( is_array( $val ) ) {
					$target_folders = array_merge( $target_folders, $val );
				} elseif ( is_string( $val ) ) {
					$target_folders[] = $val;
				}
			}
		}

		$target_folders = array_filter( array_unique( $target_folders ) );

		if ( empty( $target_folders ) && ! empty( $theme_custom['scheme'] ) ) {
			$target_folders[] = $theme_custom['scheme'];
		}

		$target_keywords = [];
		$keyword_keys    = [ 'imageKeywords', 'image-keywords', 'image_keywords', 'imageKeyword', 'image-keyword', 'keywords' ];
		
		$settings_sources = array_filter( [ $theme_custom, $custom_settings ] );

		foreach ( $settings_sources as $source ) {
			if ( ! is_array( $source ) ) {
				continue;
			}

			foreach ( $keyword_keys as $key ) {
				if ( ! empty( $source[ $key ] ) ) {
					$val = $source[ $key ];
					if ( is_array( $val ) ) {
						$target_keywords = array_merge( $target_keywords, $val );
					} elseif ( is_string( $val ) ) {
						$target_keywords[] = $val;
					}
				}
			}

			foreach ( $source as $key => $val ) {
				if ( preg_match( '/^image[-_]?keyword[s]?[-_]?\d+$/i', $key ) && ! empty( $val ) ) {
					if ( is_array( $val ) ) {
						$target_keywords = array_merge( $target_keywords, $val );
					} elseif ( is_string( $val ) ) {
						$target_keywords[] = $val;
					}
				}
			}
		}

		$target_keywords = array_filter( array_map( 'trim', array_unique( $target_keywords ) ) );

		$child_theme_root = wp_normalize_path( get_stylesheet_directory() );
		$full_base_path   = trailingslashit( $child_theme_root ) . $base_path;
		$paths_to_scan    = [];

		if ( ! empty( $target_folders ) ) {
			foreach ( $target_folders as $folder ) {
				$folder_path = trailingslashit( $full_base_path ) . trim( $folder, '/' ) . '/';
				if ( is_dir( $folder_path ) ) {
					$paths_to_scan[] = $folder_path;
				}
			}
		}

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

		foreach ( $paths_to_scan as $scan_path ) {
			$search_pattern = trailingslashit( $scan_path ) . '*.{jpg,jpeg,png,gif,webp,svg}';
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

						if ( ! $should_exclude && ! empty( $target_keywords ) ) {
							$has_keyword_match = false;
							foreach ( $target_keywords as $kw ) {
								if ( ! empty( $kw ) && stripos( $filename, $kw ) !== false ) {
									$has_keyword_match = true;
									break;
								}
							}
							if ( ! $has_keyword_match ) {
								$should_exclude = true;
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

		if ( ! empty( $images ) ) {
			$hash_seed            = 'lumina_' . $pid;
			$hashed_val           = abs( crc32( $hash_seed ) );
			$last_digit           = $hashed_val % count( $images );
			$target_relative_path = $images[ $last_digit ];
		} else {
			$target_relative_path = $true_default;
		}

		$default_url = get_stylesheet_directory_uri() . '/' . $target_relative_path;
		$default_url = apply_filters( 'lumina_default_image_url', $default_url, $pid );

		$image_alt = esc_attr( get_the_title( $pid ) );
		$image_alt = apply_filters( 'lumina_default_image_alt', $image_alt, $pid );

		return [
			'url' => $default_url,
			'alt' => $image_alt
		];
	}
}

/**
 * 2A. THE COVER TOGGLE INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_cover_block_fallback' ) ) {
	function filter_cover_block_fallback( $block_content, $block ) {
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

		if ( ! empty( $block['attrs']['useFeaturedImage'] ) && ( $force_override || ! get_post_thumbnail_id( get_the_ID() ) ) ) {
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
 * 2B. THE MEDIA & TEXT TOGGLE INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_media_text_block_fallback' ) ) {
	function filter_media_text_block_fallback( $block_content, $block ) {
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

		if ( ! empty( $block['attrs']['useFeaturedImage'] ) && ( $force_override || ! get_post_thumbnail_id( get_the_ID() ) ) ) {
			$fallback = get_featured_image_fallback_data( get_the_ID() );

			// 1. Handle inline background images (if imageFill mode is enabled)
			if ( preg_match( '/url\([^)]*\)/i', $block_content ) ) {
				$block_content = preg_replace( '/url\([^)]*\)/', 'url(' . esc_url( $fallback['url'] ) . ')', $block_content );
			}

			// 2. If an <img> tag already exists inside the block, swap its src
			if ( preg_match( '/<img[^>]+>/i', $block_content ) ) {
				$block_content = preg_replace( '/src=["\']([^"\']*)["\']/i', 'src="' . esc_url( $fallback['url'] ) . '"', $block_content );
			} else {
				// 3. If core rendered an empty <figure> wrapper, inject the fallback <img> tag directly
				$img_tag = sprintf(
					'<img src="%s" alt="%s" class="wp-post-image" />',
					esc_url( $fallback['url'] ),
					esc_attr( $fallback['alt'] )
				);

				$block_content = preg_replace(
					'/(<figure[^>]*class=["\'][^"\']*wp-block-media-text__media[^"\']*["\'][^>]*>)([\s\S]*?)(<\/figure>)/i',
					'$1' . $img_tag . '$3',
					$block_content
				);
			}
		}
		return $block_content;
	}
	add_filter( 'render_block_core/media-text', __NAMESPACE__ . '\filter_media_text_block_fallback', 10, 2 );
}

/**
 * 3. THE LEGACY INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_legacy_post_thumbnail_html' ) ) {
	function filter_legacy_post_thumbnail_html( $html, $pid, $post_thumbnail_id, $size, $attr ) {
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

		// Only force fallback if constant is true OR post missing a real thumbnail
		if ( $force_override || ! $post_thumbnail_id ) {
			$fallback    = get_featured_image_fallback_data( $pid );
			$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
			
			if ( is_array( $attr ) && ! empty( $attr['class'] ) ) {
				$image_class .= ' ' . $attr['class'];
			}

			$image_style = ( is_array( $attr ) && ! empty( $attr['style'] ) ) ? $attr['style'] : '';
			
			preg_match( "/max-width:(\\d+).*max-height:(\\d+)/", $image_style, $dimensions );
			
			$image_dimensions = $dimensions ? sprintf( 'width="%d" height="%d"', $dimensions[1], $dimensions[2] ) : '';
			$image_style     .= $dimensions ? sprintf( 'width:%dpx;height:%dpx;', $dimensions[1], $dimensions[2] ) : '';
			
			return sprintf(
				'<img loading="lazy" decoding="async" src="%s" alt="%s" class="%s" style="%s" %s />',
				esc_url( $fallback['url'] ),
				esc_attr( $fallback['alt'] ),
				esc_attr( trim( $image_class ) ),
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