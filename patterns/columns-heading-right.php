<?php
/**
 * Title: Lumina Split Section (Content Left & Heading Right)
 * Slug: lumina/columns-heading-right
 * Categories: lumina, column, text, featured
 * Block Types: core/columns
 * Description: 67/33 column layout with body content on the left and styled heading on the right.
 */
?>
<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Content Left"}} -->
<div class="wp-block-columns alignwide">
	
	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'Start typing your main content, insert a list, or drop in feature cards here...', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"}} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Section Title', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

</div>
<!-- /wp:columns -->