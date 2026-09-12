<?php
/**
 * Title: Sample Services Page
 * Slug: lumina/page-services
 * Categories: lumina, page
 * Block Types: core/post-content
 * Description: Service capabilities page with metrics breakdown, pricing tables, interactive FAQ, and CTA.
 */
?>

<!-- wp:pattern {"slug":"lumina/cover-scroll-static-image"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"what-we-do"} -->
	<h2 class="wp-block-heading is-style-separator" id="what-we-do"><?php esc_html_e("Capabilities & Services", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("We combine strategic design systems, responsive block architectures, and performant web engineering to bring your digital vision into focus.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-features-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/columns-intro+3x2-dividers"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"our-pricing"} -->
	<h2 class="wp-block-heading is-style-separator" id="our-pricing"><?php esc_html_e("Transparent Pricing Tiers", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("Value-driven tiers engineered for launching personal brands, scaling digital platforms, and powering enterprise experiences.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-pricing-tables-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/faq-2-columns"} /-->

<!-- wp:pattern {"slug":"lumina/buttons-call-to-action-dark-full-width"} /-->