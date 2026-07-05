<?php
/**
 * File:        category-colors.php
 * Theme:       Lumina Blocks
 *
 * Fluid Theme Variation Architecture for Categories. Intercepts hex strings
 * from legacy admin pickers, compiles them down into active theme.json slugs,
 * and resolves them dynamically at runtime. Allows term styling to transition
 * flawlessly when a user loads an alternate color palette or style variation.
 *
 * @package     lumina
 */

/**
 * 1. THE PALETTE MAPPING ENGINE
 * Queries theme.json at runtime to assemble bidirectional mapping arrays
 * between active semantic design slugs and physical layout hex strings.
 */
function lumina_get_theme_palette_mapping() {
	$target_slugs = [
		'primary',
		'primary-alt',
		'secondary',
		'secondary-alt',
		'tertiary',
		'tertiary-alt',
		'dark',
		'dark-alt'
	];
	
	$palette_by_slug  = [];
	$slug_by_palette  = [];

	if ( function_exists( 'wp_get_global_settings' ) ) {
		// Fetch active color records from both static layout templates and global custom styles
		$theme_palette  = wp_get_global_settings( array( 'color', 'palette', 'theme' ) );
		$custom_palette = wp_get_global_settings( array( 'color', 'palette', 'custom' ) );
		
		$merged_palette = array_merge( 
			is_array( $custom_palette ) ? $custom_palette : [], 
			is_array( $theme_palette ) ? $theme_palette : [] 
		);

		if ( ! empty( $merged_palette ) ) {
			foreach ( $merged_palette as $color_node ) {
				if ( ! empty( $color_node['color'] ) && is_string( $color_node['color'] ) && ! empty( $color_node['slug'] ) ) {
					if ( 0 === strpos( $color_node['color'], '#' ) ) {
						$palette_by_slug[ $color_node['slug'] ] = $color_node['color'];
						$slug_by_palette[ strtolower( $color_node['color'] ) ] = $color_node['slug'];
					}
				}
			}
		}
	}

	// Prioritize your 8 core targeted design system slugs
	$final_slug_to_hex = [];
	$final_hex_to_slug = [];

	foreach ( $target_slugs as $slug ) {
		if ( isset( $palette_by_slug[ $slug ] ) ) {
			$final_slug_to_hex[ $slug ] = $palette_by_slug[ $slug ];
			$final_hex_to_slug[ strtolower( $palette_by_slug[ $slug ] ) ] = $slug;
		}
	}

	// BACKFILL: Supplement missing tokens using unassigned theme.json definitions
	if ( count( $final_slug_to_hex ) < 8 && ! empty( $slug_by_palette ) ) {
		foreach ( $slug_by_palette as $hex => $slug ) {
			if ( count( $final_slug_to_hex ) >= 8 ) {
				break;
			}
			if ( ! isset( $final_slug_to_hex[ $slug ] ) ) {
				$final_slug_to_hex[ $slug ] = $hex;
				$final_hex_to_slug[ strtolower( $hex ) ] = $slug;
			}
		}
	}

	// RECOVERY FALLBACK: Hardcoded default layout fallback parameters if theme.json is missing
	if ( empty( $final_slug_to_hex ) ) {
		$fallbacks = [
			'primary'       => '#4f46e5',
			'primary-alt'   => '#0ea5e9',
			'secondary'     => '#06b6d4',
			'secondary-alt' => '#10b981',
			'tertiary'      => '#84cc16',
			'tertiary-alt'  => '#eab308',
			'dark'          => '#0a0a0a',
			'dark-alt'      => '#2c3539'
		];
		foreach ( $fallbacks as $s => $h ) {
			$final_slug_to_hex[ $s ] = $h;
			$final_hex_to_slug[ strtolower( $h ) ] = $s;
		}
	}

	return [
		'slug_to_hex'   => $final_slug_to_hex,
		'hex_to_slug'   => $final_hex_to_slug,
		'ordered_slugs' => array_keys( $final_slug_to_hex ),
		'ordered_hexes' => array_values( $final_slug_to_hex )
	];
}

/**
 * 2. RESOLUTION ENGINE (THE ABSTRACTION LAYER)
 */

/**
 * Calculates a fallback token slug deterministically using Term ID modulus layout paths.
 */
function lumina_get_category_default_slug( $term_id ) {
	$mapping = lumina_get_theme_palette_mapping();
	$slugs   = $mapping['ordered_slugs'];
	$index   = abs( intval( $term_id ) ) % count( $slugs );
	return $slugs[ $index ];
}

/**
 * Calculates a fallback hex color deterministically using Term ID modulus layout paths.
 */
function lumina_get_category_default_color( $term_id ) {
	$mapping      = lumina_get_theme_palette_mapping();
	$default_slug = lumina_get_category_default_slug( $term_id );
	return isset( $mapping['slug_to_hex'][ $default_slug ] ) ? $mapping['slug_to_hex'][ $default_slug ] : '#ffffff';
}

/**
 * Resolves any category down to its true active Hex Color string.
 */
function lumina_get_category_color( $term_id ) {
	if ( ! $term_id ) {
		return '#ffffff';
	}
	
	$raw_meta = get_term_meta( $term_id, 'lumina_category_color', true );
	$mapping  = lumina_get_theme_palette_mapping();

	// Case A: No design choice recorded yet -> fall back to dynamic default slug hex
	if ( ! $raw_meta ) {
		return lumina_get_category_default_color( $term_id );
	}

	// Case B: Metadata contains a raw hex code -> returned directly (User chose a non-palette color)
	if ( preg_match( '/^#[a-f0-9]{6}$/i', $raw_meta ) ) {
		return $raw_meta;
	}

	// Case C: Metadata contains a semantic design slug -> resolve hex from active palette map
	if ( isset( $mapping['slug_to_hex'][ $raw_meta ] ) ) {
		return $mapping['slug_to_hex'][ $raw_meta ];
	}

	return '#ffffff';
}

/**
 * Resolves any category down to its abstract design slug token identifier string.
 */
function lumina_get_category_slug( $term_id ) {
	if ( ! $term_id ) {
		return 'white';
	}
	
	$raw_meta = get_term_meta( $term_id, 'lumina_category_color', true );
	if ( ! $raw_meta ) {
		return lumina_get_category_default_slug( $term_id );
	}

	if ( preg_match( '/^#[a-f0-9]{6}$/i', $raw_meta ) ) {
		return 'custom'; 
	}

	return $raw_meta;
}

/**
 * 3. ADMIN INTERFACE & ENQUEUES
 */
add_action( 'admin_enqueue_scripts', 'lumina_enqueue_category_color_picker' );
function lumina_enqueue_category_color_picker( $hook ) {
	$screen = get_current_screen();
	
	if ( isset( $screen->taxonomy ) && 'category' === $screen->taxonomy ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		
		$mapping = lumina_get_theme_palette_mapping();
		
		$inline_js = sprintf(
			"jQuery(document).ready(function($){
				$('.lumina-color-field').wpColorPicker({
					palettes: %s
				});
			});",
			json_encode( $mapping['ordered_hexes'] )
		);
		
		wp_add_inline_script( 'wp-color-picker', $inline_js );
	}
}

/**
 * 4. ADMIN INTERFACE FORM FIELDS
 */

/**
 * Renders input field on the "Add New Category" layout panel.
 */
add_action( 'category_add_form_fields', 'lumina_add_category_color_field', 10, 1 );
function lumina_add_category_color_field( $taxonomy ) {
	$mapping = lumina_get_theme_palette_mapping();
	$default_hex = ! empty( $mapping['ordered_hexes'] ) ? $mapping['ordered_hexes'][0] : '#ffffff';
	?>
	<div class="form-field term-color-wrap">
		<label for="lumina_category_color"><?php _e( 'Category Color Accent', 'lumina' ); ?></label>
		<input type="text" name="lumina_category_color" id="lumina_category_color" class="lumina-color-field" value="" data-default-color="<?php echo esc_attr( $default_hex ); ?>" />
		<p class="description"><?php _e( 'Choose a signature accent color for this category label. Leave blank to use automated palette distribution.', 'lumina' ); ?></p>
	</div>
	<?php
}

/**
 * Renders input row on the "Edit Category" management dashboard table.
 */
add_action( 'category_edit_form_fields', 'lumina_edit_category_color_field', 10, 2 );
function lumina_edit_category_color_field( $term, $taxonomy ) {
	$resolved_hex     = lumina_get_category_color( $term->term_id );
	$true_default_hex = lumina_get_category_default_color( $term->term_id );
	?>
	<tr class="form-field term-color-wrap">
		<th scope="row"><label for="lumina_category_color"><?php _e( 'Category Color Accent', 'lumina' ); ?></label></th>
		<td>
			<input type="text" name="lumina_category_color" id="lumina_category_color" class="lumina-color-field" value="<?php echo esc_attr( $resolved_hex ); ?>" data-default-color="<?php echo esc_attr( $true_default_hex ); ?>" />
			<p class="description"><?php _e( 'Choose a signature accent color from your theme palette. Hitting "Clear" or "Default" restores your theme\'s automated ID calculation.', 'lumina' ); ?></p>
		</td>
	</tr>
	<?php
}

/**
 * 5. DATABASE INTERCEPT (THE REVERSE TRANSLATOR)
 */
add_action( 'created_category', 'lumina_save_category_color', 10, 1 );
add_action( 'edited_category', 'lumina_save_category_color', 10, 1 );
function lumina_save_category_color( $term_id ) {
	if ( isset( $_POST['lumina_category_color'] ) ) {
		$raw_input = sanitize_text_field( $_POST['lumina_category_color'] );
		
		if ( 0 === strpos( $raw_input, '#' ) ) {
			$mapping   = lumina_get_theme_palette_mapping();
			$clean_hex = strtolower( $raw_input );
			
			if ( isset( $mapping['hex_to_slug'][ $clean_hex ] ) ) {
				update_term_meta( $term_id, 'lumina_category_color', sanitize_key( $mapping['hex_to_slug'][ $clean_hex ] ) );
				return;
			}
			
			update_term_meta( $term_id, 'lumina_category_color', sanitize_hex_color( $raw_input ) );
		} else {
			update_term_meta( $term_id, 'lumina_category_color', sanitize_key( $raw_input ) );
		}
	}
}

/**
 * 6. FRONT-END LOOP INTEGRATION HELPERS
 */
function lumina_get_post_primary_category_id( $post_id = null ) {
	$pid = $post_id ? $post_id : get_the_ID();
	if ( ! $pid ) {
		return null;
	}

	$yoast_primary = get_post_meta( $pid, '_yoast_wpseo_primary_category', true );
	if ( $yoast_primary ) {
		return intval( $yoast_primary );
	}

	$rank_math_primary = get_post_meta( $pid, 'rank_math_primary_category', true );
	if ( $rank_math_primary ) {
		return intval( $rank_math_primary );
	}

	$categories = get_the_category( $pid );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		return $categories[0]->term_id;
	}

	return null;
}

function lumina_get_post_primary_category_color( $post_id = null ) {
	$category_id = lumina_get_post_primary_category_id( $post_id );
	return $category_id ? lumina_get_category_color( $category_id ) : '#ffffff';
}

function lumina_get_post_primary_category_slug( $post_id = null ) {
	$category_id = lumina_get_post_primary_category_id( $post_id );
	return $category_id ? lumina_get_category_slug( $category_id ) : 'white';
}

/**
 * 7. ADMIN DASHBOARD LIST COLUMNS
 * Appends a dedicated visual "Color" column to the category management table.
 */

// Hook A: Register the custom column header label
add_filter( 'manage_edit-category_columns', 'lumina_register_category_color_column' );
function lumina_register_category_color_column( $columns ) {
	// Insert the column right after the description or name column
	$new_columns = [];
	foreach ( $columns as $key => $title ) {
		$new_columns[$key] = $title;
		if ( 'name' === $key ) {
			$new_columns['lumina_color'] = __( 'Color', 'lumina' );
		}
	}
	return $new_columns;
}

// Hook B: Populate the column row frames with your dynamic color dot markup
add_filter( 'manage_category_custom_column', 'lumina_populate_category_color_column', 10, 3 );
function lumina_populate_category_color_column( $content, $column_name, $term_id ) {
	if ( 'lumina_color' === $column_name && function_exists( 'lumina_get_category_color' ) ) {
		$color = lumina_get_category_color( $term_id );
		$slug  = function_exists( 'lumina_get_category_slug' ) ? lumina_get_category_slug( $term_id ) : '';
		
		// Build descriptive title hover state data for debug tracking
		$hover_label = ( $slug && 'custom' !== $slug ) ? sprintf( 'Slug Token: %s (%s)', $slug, $color ) : 'Custom Hex: ' . $color;

		// Output an inline flex container with a round canvas dot element
		return sprintf(
			'<span class="lumina-admin-color-dot" style="display:inline-block; width:14px; height:14px; border-radius:50%%; background-color:%1$s; border:1px solid rgba(0,0,0,0.15); vertical-align:middle;" title="%2$s"></span>',
			esc_attr( $color ),
			esc_attr( $hover_label )
		);
	}
	return $content;
}

// Hook C: Inject a small CSS snippet into the dashboard head to lock down column alignment
add_action( 'admin_head', 'lumina_category_color_column_styles' );
function lumina_category_color_column_styles() {
	$screen = get_current_screen();
	if ( isset( $screen->taxonomy ) && 'category' === $screen->taxonomy ) {
		echo '<style>
			.wp-list-table .column-lumina_color { width: 65px; text-align: center; }
			.wp-list-table .column-lumina_color .lumina-admin-color-dot { margin: 0 auto; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
		</style>';
	}
}
