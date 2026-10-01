<?php
/**
 * Title: Page Services
 * Description: Studio Capabilities and services overview page with technical feature breakdowns, pricing tables, facility details, interactive FAQ, and CTA.
 * Slug: lumina/page-services
 * Categories: lumina, page
 * Block Types: core/post-content
 */
?>
<!-- wp:pattern {"slug":"lumina/banner-hero-media-text"} /-->

<!-- wp:group {"metadata":{"name":"Intro + Text"},"align":"full","layout":{"type":"constrained"},"anchor":"intro-text"} -->
<div class="wp-block-group alignfull" id="intro-text">
<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Heading Left"}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"}} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator","anchor":"what-we-do"} -->
		<h2 class="wp-block-heading is-style-separator" id="what-we-do"><?php esc_html_e( 'Capabilities & Services', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'We combine strategic design systems, responsive block architectures, and performant web engineering to bring your digital vision into focus.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-features-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/hidden-feature-grid-start"} /-->

<!-- wp:pattern {"slug":"lumina/columns-intro-3x2-dividers"} /-->

<!-- wp:pattern {"slug":"lumina/columns-sub-tables-4"} /-->

<!-- wp:group {"metadata":{"name":"Intro + Text"},"align":"full","layout":{"type":"constrained"},"anchor":"intro-text"} -->
<div class="wp-block-group alignfull" id="intro-text">
<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Content Left"}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'Value-driven tiers engineered for launching personal brands, scaling digital platforms, and powering enterprise experiences.', 'lumina' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"},"className":"is-style-first-on-mobile"} -->
	<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator","anchor":"our-pricing"} -->
		<h2 class="wp-block-heading is-style-separator" id="our-pricing"><?php esc_html_e( 'Transparent Pricing Tiers', 'lumina' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-pricing-table-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/columns-image-contact"} /-->

<!-- wp:pattern {"slug":"lumina/text-faq"} /-->

<!-- wp:pattern {"slug":"lumina/buttons-call-to-action-dark-full"} /-->