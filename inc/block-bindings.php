<?php
/**
 * File:	block-bindings.php
 * Theme:	Shared Block Binding Functions
 * 
 * @package XtremelySocial
 */

namespace XtremelySocial\Lumina;

add_action( 'init', __NAMESPACE__ . '\register_block_bindings' );

function register_block_bindings() {

	// Featured Image (Lightbox, Template Part & Fallback Engine Compatible)
	register_block_bindings_source( 'lumina/featured-image', array(
		'label'              => __( 'Featured Image', 'lumina' ),
		'get_value_callback' => __NAMESPACE__ . '\featured_image_binding',
		'uses_context'       => array( 'postId' ),
	) );

}

/* Featured Image binding source */
function featured_image_binding( $source_args, $block_instance, $attribute_name = 'url' ) {
	// 1. Four-tier Post ID lookup to guarantee context inside template parts
	$post_id = 0;

	if ( ! empty( $block_instance->context['postId'] ) ) {
		$post_id = (int) $block_instance->context['postId'];
	}

	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! $post_id ) {
		global $post;
		if ( isset( $post->ID ) ) {
			$post_id = $post->ID;
		}
	}

	if ( ! $post_id ) {
		return null;
	}

	// Determine attribute name ('url' or 'alt')
	$target_attr = ! empty( $attribute_name ) ? $attribute_name : ( $source_args['attr'] ?? 'url' );

	// Check if testing override is active
	$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

	// 2. Fetch REAL Featured Image (Skipped if testing override is set to true)
	if ( ! $force_override ) {
		$thumb_id = get_post_thumbnail_id( $post_id );

		if ( $thumb_id ) {
			if ( 'url' === $target_attr ) {
				$url = wp_get_attachment_image_url( $thumb_id, 'full' );
				if ( $url ) {
					return $url;
				}
			}

			if ( 'alt' === $target_attr ) {
				return get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $post_id );
			}
		}
	}

	// 3. Fallback Engine: Triggered if no real image exists OR if FORCE_DEFAULT_IMAGE is true
	if ( function_exists( '\XtremelySocial\get_featured_image_fallback_data' ) ) {
		$fallback = \XtremelySocial\get_featured_image_fallback_data( $post_id );
		
		if ( 'url' === $target_attr ) {
			return $fallback['url'] ?? null;
		}
		
		if ( 'alt' === $target_attr ) {
			return $fallback['alt'] ?? get_the_title( $post_id );
		}
	}

	return null;
}