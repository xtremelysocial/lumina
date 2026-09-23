<?php
/**
 * Title: Page Home
 * Description: Studio Home Page layout showcasing brand hero, editorial narrative, multi-column features, media spotlights, and recent posts.
 * Slug: lumina/page-home
 * Categories: lumina, page
 * Block Types: core/post-content
 */
?>
<!-- wp:pattern {"slug":"lumina/banner-home-hero-media-text"} /-->

<!-- wp:pattern {"slug":"lumina/columns-site-motto-details"} /-->

<!-- wp:pattern {"slug":"lumina/columns-features-4-columns"} /-->

<!-- wp:group {"metadata":{"name":"Intro + Text"},"align":"full","layout":{"type":"constrained"},"anchor":"intro-text"} -->
<div class="wp-block-group alignfull" id="intro-text">
<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Heading Left"}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"}} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Design Systems & Editorial Layouts', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'Lumina combines modular Gutenberg block architecture with fluid typography, responsive layout dynamics, and precise visual hierarchy to deliver flexible editorial experiences.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-drop-caps-3"} /-->

<!-- wp:pattern {"slug":"lumina/columns-features-dividers-3x2"} /-->

<!-- wp:group {"metadata":{"name":"Intro + Text"},"align":"full","layout":{"type":"constrained"},"anchor":"intro-text"} -->
<div class="wp-block-group alignfull" id="intro-text">
<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Content Left"},"anchor":"feature-grid"} -->
<div class="wp-block-columns alignwide" id="feature-grid">
	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'Engineered from the ground up for seamless light and dark color scheme adaptability, strict WCAG AA contrast compliance, and peak browser performance.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"},"className":"is-style-first-on-mobile"} -->
	<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Engineered Performance', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/image-left-and-right-text"} /-->

<!-- wp:pattern {"slug":"lumina/columns-intro-3x2-dividers"} /-->

<!-- wp:pattern {"slug":"lumina/columns-sub-tables-3"} /-->

<!-- wp:pattern {"slug":"lumina/image-gallery"} /-->

<!-- wp:pattern {"slug":"lumina/text-testimonial"} /-->

<!-- wp:pattern {"slug":"lumina/columns-recent-posts-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/buttons-call-to-action-dark-full"} /-->