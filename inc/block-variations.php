<?php
/**
 * File:        block-variations.php
 * Theme:       Shared Block Variations Engine
 *
 * Registers true Block Variations (appear as separate blocks in the Editor).
 * These must be registered this way and not with style.json as those are just
 * for custom block styles, not variations. 
 *
 * @package     XtremelySocial
 */

// namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register 33/67 Split Column variation in the initial Columns placeholder grid.
 */
add_filter( 'get_block_type_variations', function( $variations, $block_type ) {
	if ( 'core/columns' !== $block_type->name ) {
		return $variations;
	}

	$variations[] = array(
		'name'        => 'lumina-split-columns',
		'title'       => __( '33 / 67 Heading & Content', 'lumina' ),
		'description' => __( 'Left column with heading separator, right column for content flow.', 'lumina' ),
		'icon'        => 'columns',
		'attributes'  => array(
			'align' => 'wide',
		),
		'innerBlocks' => array(
			array(
				'core/column',
				array( 'width' => '33.33%' ),
				array(
					array(
						'core/heading',
						array(
							'level'     => 2,
							'className' => 'is-style-separator',
							'content'   => __( 'Section Title', 'lumina' ),
						),
					),
				),
			),
			array(
				'core/column',
				array( 'width' => '66.66%' ),
				array(
					array(
						'core/paragraph',
						array(
							'content' => __( 'Start typing main content or drop components here...', 'lumina' ),
						),
					),
				),
			),
		),
		'scope'       => array( 'block' ), // Tells WP to put this directly in the block's initial placeholder grid!
	);

	return $variations;
}, 10, 2 );