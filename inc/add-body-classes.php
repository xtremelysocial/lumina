<?php
/**
 * File:		add-body-classes.php
 * Theme:		Atmos Blocks
 * 
 * Adds classes on the body tag for specific theme variation and is-dark or
 * is-light based on the the background color.
 * 
 * @package 	atmos-blocks
 */

// add_action( 'wp_head', function() {
// 	// Only run this for logged-in administrators so visitors don't see it
// 	if ( ! current_user_can( 'administrator' ) ) {
// 		return;
// 	}
// 
// 	echo '<pre style="background: #0A0A0A; color: #00FF66; padding: 30px; font-family: monospace; font-size: 13px; line-height: 1.6; overflow: auto; max-height: 90vh; position: fixed; inset: 20px; z-index: 999999; border: 2px solid #00FF66; box-shadow: 0 20px 40px rgba(0,0,0,0.8);">';
// 	echo "========================================================================\n";
// 	echo "               ATMOS BLOCKS: GLOBAL STYLES DATA HUNT                    \n";
// 	echo "========================================================================\n\n";
// 
// 	// 1. Locate the core Post ID
// 	$post_id = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();
// 	echo "[1] DETECTED GLOBAL STYLES POST ID: " . ( $post_id ? $post_id : "NONE FOUND (Theme defaults active)" ) . "\n\n";
// 
// 	if ( $post_id ) {
// 		$post = get_post( $post_id );
// 		
// 		echo "------------------------------------------------------------------------\n";
// 		echo "[2] RAW POST OBJECT COLUMNS\n";
// 		echo "------------------------------------------------------------------------\n";
// 		echo "ID:           " . $post->ID . "\n";
// 		echo "Post Title:   " . $post->post_title . "\n";
// 		echo "Post Name:    " . $post->post_name . "\n";
// 		echo "Post Excerpt: " . ( $post->post_excerpt ? "'" . $post->post_excerpt . "'" : "EMPTY" ) . "\n";
// 		echo "Post Status:  " . $post->post_status . "\n\n";
// 
// 		echo "------------------------------------------------------------------------\n";
// 		echo "[3] DECODED POST_CONTENT JSON TREE\n";
// 		echo "------------------------------------------------------------------------\n";
// 		$content = json_decode( $post->post_content, true );
// 		if ( json_last_error() === JSON_ERROR_NONE ) {
// 			print_r( $content );
// 		} else {
// 			echo "!! FAILED TO DECODE JSON: " . json_last_error_msg() . "\n";
// 			echo "RAW CONTENT SNIPPET:\n" . esc_html( substr( $post->post_content, 0, 1000 ) ) . "...\n";
// 		}
// 	} else {
// 		echo "If this is empty, go into the Site Editor, make one tiny visual adjustment \n";
// 		echo "(like tweaking a padding value or changing a text color) and hit save. \n";
// 		echo "This forces WordPress to write the active config post into the database.\n";
// 	}
// 
// 	echo "\n========================================================================\n";
// 	echo "                     END OF DIAGNOSTIC DUMP                             \n";
// 	echo "========================================================================\n";
// 	echo '</pre>';
// 	exit; // Kill the execution line here so you can read cleanly
// } );


add_filter( 'body_class', 'atmos_add_body_classes', 10, 1 );

if ( ! function_exists('atmos_add_body_classes') ) :
 
	function atmos_add_body_classes( $classes ) {

		// -------------------------------------------------------------------------
		// 1. EXTRACT VARIATION FILE SLUG VIA THEME MODIFICATION REGISTRY
		// -------------------------------------------------------------------------
// 		$variation_slug = 'default';
// 		
// 		// WordPress stores the active variation filename here when customized (e.g., "580-atmos-zinc")
// 		$active_variant = get_theme_mod( 'theme_style_variation' );
// 
// 		if ( ! empty( $active_variant ) ) {
// 			// This regex pattern strips any leading sort numbers and hyphens from the front
// 			$variation_slug = preg_replace( '/^\d+-/', '', $active_variant );
// 		}
// 
// 		// Appends exactly "theme-style-atmos-zinc", "theme-style-default", etc.
// 		$classes[] = 'theme-style-' . sanitize_title( $variation_slug );

		// -------------------------------------------------------------------------
		// 1. EXTRACT VARIATION FILE SLUG VIA GENUINE WORDPRESS CORE METHOD
		// -------------------------------------------------------------------------
// 		$variation_slug = 'default';
// 		$global_styles_id = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();
// 
// 		if ( $global_styles_id ) {
// 			$style_post = get_post( $global_styles_id );
// 			
// 			// WordPress natively stores the active variation filename in the post_excerpt (e.g., "580-atmos-zinc")
// 			if ( $style_post && ! empty( $style_post->post_excerpt ) ) {
// 				// This regex pattern strips any leading sort numbers and hyphens from the front
// 				$variation_slug = preg_replace( '/^\d+-/', '', $style_post->post_excerpt );
// 			}
// 		}
// 
// 		// Appends exactly "theme-style-atmos-zinc", "theme-style-default", etc.
// 		$classes[] = 'theme-style-' . sanitize_title( $variation_slug );

		// -------------------------------------------------------------------------
		// 1. EXTRACT VARIATION FILE SLUG VIA THE USER CONFIG DATA
		// -------------------------------------------------------------------------
// 		$user_data = WP_Theme_JSON_Resolver::get_user_data_from_wp_global_styles( wp_get_theme() );
// 		$variation_slug = 'default';
// 
// 		// Cross-reference the post array keys returned natively by the Core API
// 		if ( ! empty( $user_data ) && ! empty( $user_data['post_excerpt'] ) ) {
// 			// user_data['post_excerpt'] carries the active variation template filename (e.g., "580-atmos-zinc")
// 			// This regex pattern strips any leading sort numbers and hyphens from the front
// 			$variation_slug = preg_replace( '/^\d+-/', '', $user_data['post_excerpt'] );
// 		}
// 
// 		// Appends exactly "theme-style-atmos-zinc", "theme-style-default", etc.
// 		$classes[] = 'theme-style-' . sanitize_title( $variation_slug );

		// -------------------------------------------------------------------------
		// 1. EXTRACT VARIATION FILE SLUG VIA THE USER CONFIG DATA
		// -------------------------------------------------------------------------
// 		$user_data = WP_Theme_JSON_Resolver::get_user_data_from_wp_global_styles( wp_get_theme() );
// 		$variation_slug = 'default';
// 
// 		if ( ! empty( $user_data ) && isset( $user_data['theme'] ) ) {
// 			// user_data['theme'] extracts the exact file slug name (e.g., "580-atmos-zinc")
// 			// This regex pattern strips any leading sort numbers and hyphens from the front
// 			$variation_slug = preg_replace( '/^\d+-/', '', $user_data['theme'] );
// 		}
// 
// 		// Appends exactly "theme-style-atmos-zinc", "theme-style-default", etc.
// 		$classes[] = 'theme-style-' . sanitize_title( $variation_slug );

		// -------------------------------------------------------------------------
		// 2. GET BACKGROUND COLOR FOR LUMINANCE CHECK
		// -------------------------------------------------------------------------
		$bg_color = wp_get_global_styles( array( 'color', 'background' ) );
		
		if ( empty( $bg_color ) ) {
			$bg_color = '#ffffff';
		}
	
		// Resolve native variable token wrappers into raw hex colors for calculation
		if ( strpos( $bg_color, 'var(--wp--preset--color--' ) !== false ) {
			preg_match( '/--wp--preset--color--([a-zA-Z0-9_-]+)/', $bg_color, $matches );
			if ( ! empty( $matches[1] ) ) {
				$bg_slug = $matches[1]; 
				$palette = wp_get_global_settings( array( 'color', 'palette', 'theme' ) );
				
				foreach ( $palette as $color_obj ) {
					if ( isset( $color_obj['slug'] ) && $color_obj['slug'] === $bg_slug ) {
						$bg_color = $color_obj['color'];
						break;
					}
				}
			}
		}

		// -------------------------------------------------------------------------
		// 3. CALCULATE AND SET LUMINANCE STATE CLASS
		// -------------------------------------------------------------------------
		$hex = str_replace( '#', '', $bg_color );
		if ( strlen( $hex ) === 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} elseif ( strlen( $hex ) === 6 ) {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		} else {
			$r = 255; $g = 255; $b = 255;
		}
	
		// Standard sRGB coefficients relative luminance calculation
		$rc = $r / 255; $gc = $g / 255; $bc = $b / 255;
		$rc = ( $rc <= 0.03928 ) ? $rc / 12.92 : pow( ( $rc + 0.055 ) / 1.055, 2.4 );
		$gc = ( $gc <= 0.03928 ) ? $gc / 12.92 : pow( ( $gc + 0.055 ) / 1.055, 2.4 );
		$bc = ( $bc <= 0.03928 ) ? $bc / 12.92 : pow( ( $bc + 0.055 ) / 1.055, 2.4 );
		
		$luminance = 0.2126 * $rc + 0.7152 * $gc + 0.0722 * $bc;
	
		if ( $luminance < 0.5 ) {
			$classes[] = 'is-dark-theme';
		} else {
			$classes[] = 'is-light-theme';
		}
	
		return $classes;
	}
	
endif;