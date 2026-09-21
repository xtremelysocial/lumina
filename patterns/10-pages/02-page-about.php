<?php
/**
 * Title: Page About
 * Description: Studio About page featuring brand narrative, core values, team grid, location mapping, and client social proof.
 * Slug: lumina/page-about
 * Categories: lumina, page
 * Block Types: core/post-content
 */
?>
<!-- wp:pattern {"slug":"lumina/banner-page-hero-media-text"} /-->

<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Heading Left"}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"}} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Digital Craftsmanship', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'We are an independent design studio dedicated to building performant WordPress themes, flexible pattern systems, and accessible digital experiences that empower creators and brands.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:pattern {"slug":"lumina/columns-drop-caps-2"} /-->

<!-- wp:pattern {"slug":"lumina/columns-site-motto-details"} /-->

<!-- wp:pattern {"slug":"lumina/columns-features-3-columns"} /-->

<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Content Left"},"anchor":"feature-grid"} -->
<div class="wp-block-columns alignwide" id="feature-grid">
	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"},"className":"is-style-first-on-mobile"} -->
	<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator","anchor":"our-team"} -->
		<h2 class="wp-block-heading is-style-separator" id="our-team"><?php esc_html_e( 'Meet Our Team', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'The creative minds, systems architects, and detail-driven designers behind Lumina’s block patterns, typography systems, and color physics.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:pattern {"slug":"lumina/columns-team-4-people"} /-->

<!-- wp:pattern {"slug":"lumina/text-testimonial"} /-->

<!-- wp:pattern {"slug":"lumina/buttons-call-to-action-2-columns-dark"} /-->

<!-- wp:pattern {"slug":"lumina/columns-map-contact"} /-->
