<?php
/**
 * Title: Page Portfolio
 * Description: Studio Creative portfolio showcase with full-bleed media spotlights, responsive galleries, device mockups, and client testimonials.
 * Slug: lumina/page-portfolio
 * Categories: lumina, page
 * Block Types: core/post-content
 */
?>
<!-- wp:pattern {"slug":"lumina/cover-scroll-static-image"} /-->

<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Heading Left"}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"}} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Featured Case Studies', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'A curated showcase of responsive site builds, component systems, device mockups, and high-impact digital experiences crafted with artistic intent and technical accuracy.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:pattern {"slug":"lumina/columns-drop-caps-2"} /-->

<!-- wp:pattern {"slug":"lumina/media-text-2-blocks"} /-->

<!-- wp:pattern {"slug":"lumina/image-left-and-right-text-screenshot"} /-->

<!-- wp:pattern {"slug":"lumina/image-computer-screen"} /-->

<!-- wp:pattern {"slug":"lumina/image-portfolio"} /-->

<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Content Left"}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'Every visual layout and image grid is engineered to scale gracefully across device viewpoints while retaining strong editorial personality.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"},"className":"is-style-first-on-mobile"} -->
	<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Systemic Design', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:pattern {"slug":"lumina/image-gallery"} /-->

<!-- wp:pattern {"slug":"lumina/image-gallery-no-gap"} /-->

<!-- wp:pattern {"slug":"lumina/image-gallery-rounded"} /-->

<!-- wp:pattern {"slug":"lumina/columns-social-media-4-columns"} /-->

<!-- wp:pattern {"slug":"lumina/text-testimonial"} /-->

<!-- wp:pattern {"slug":"lumina/buttons-call-to-action-centered"} /-->