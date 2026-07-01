<?php
/**
 * Registers the dynamic Atmos Page Header block and handles
 * context-aware server-side rendering logic.
 */
add_action( 'init', 'atmos_register_dynamic_page_header_block' );
function atmos_register_dynamic_page_header_block() {
	register_block_type(
		__DIR__ . '/../blocks/page-header',
		array(
			'render_callback' => 'atmos_render_dynamic_page_header'
		)
	);
}

function atmos_render_dynamic_page_header( $attributes ) {
	$title    = '';
	$subtitle = '';
	
	// -------------------------------------------------------------------------
	// 1. DYNAMIC TITLE & SUBTITLE LOOKUP MATRIX
	// -------------------------------------------------------------------------
	if ( is_front_page() && is_home() ) {
		// Default blog listing home page setting
		$title    = get_bloginfo( 'name' );
		$subtitle = get_bloginfo( 'description' );
	} elseif ( is_home() ) {
		// Static Post Page index view
		$blog_page_id = get_option( 'page_for_posts' );
		$title        = $blog_page_id ? get_the_title( $blog_page_id ) : __( 'Blog', 'atmos' );
		$subtitle     = $blog_page_id ? get_post_meta( $blog_page_id, '_subtitle', true ) : '';
	} elseif ( is_search() ) {
		$title    = sprintf( __( 'Search Results for: %s', 'atmos' ), get_search_query() );
		$subtitle = sprintf( __( 'Found %s matches matching your parameters.', 'atmos' ), $GLOBALS['wp_query']->found_posts );
	} elseif ( is_category() ) {
		$title    = single_cat_title( '', false );
		$subtitle = get_the_archive_description();
	} elseif ( is_tag() ) {
		$title    = single_tag_title( '', false );
		$subtitle = get_the_archive_description();
	} elseif ( is_archive() ) {
		// Cleans up old core prefixes like "Archives: " safely
		$title    = get_the_archive_title();
		$subtitle = get_the_archive_description();
	} elseif ( is_singular() ) {
		$title    = get_the_title();
		$subtitle = get_post_meta( get_the_ID(), '_subtitle', true );
	} else {
		$title    = get_the_title();
		$subtitle = __( 'Document Feed Index', 'atmos' );
	}

	if ( empty( $title ) ) {
		return '';
	}

	// -------------------------------------------------------------------------
	// 2. BLOCK ATTR CLASS COMPILATION
	// -------------------------------------------------------------------------
	$classes = array( 'wp-block-atmos-page-header', 'entry-header' );
	
	// Append alignment utilities if set in the editor sidebar controls
	if ( ! empty( $attributes['textAlign'] ) ) {
		$classes[] = 'has-text-align-' . $attributes['textAlign'];
	}
	
	// Apply layout color presets natively if set by users
	if ( ! empty( $attributes['textColor'] ) ) {
		$classes[] = 'has-text-color';
		$classes[] = 'has-' . $attributes['textColor'] . '-color';
	}

	$class_string = implode( ' ', array_map( 'sanitize_html_class', $classes ) );

	// -------------------------------------------------------------------------
	// 3. CODE OUTPUT BUILDER
	// -------------------------------------------------------------------------
	$output = sprintf( '<header class="%s">', esc_attr( $class_string ) );
	$output .= sprintf( '<h1 class="entry-title wp-block-post-title">%s</h1>', esc_html( $title ) );

	if ( ! empty( $subtitle ) ) {
		// Clean up formatting block layers out of descriptions safely
		$clean_subtitle = wp_strip_all_tags( $subtitle );
		$output .= sprintf(
			'<div class="entry-subtitle is-style-separator has-medium-font-size">%s</div>',
			esc_html( $clean_subtitle )
		);
	}

	$output .= '</header>';
	return $output;
}