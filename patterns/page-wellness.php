<?php
/**
 * Title: Sample Wellness Page
 * Slug: lumina/page-wellness
 * Categories: lumina, page
 * Block Types: core/post-content
 * Description: A serene studio template designed for yoga, meditation, and holistic health practices.
 */
?>

<!-- wp:pattern {"slug":"lumina/banner-home-hero-media-text"} /-->

<!-- wp:pattern {"slug":"lumina/features-intro+2-columns"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"membership-passes"} -->
	<h2 class="wp-block-heading is-style-separator" id="membership-passes"><?php esc_html_e("Studio Memberships & Passes", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("Flexible drop-in rates, monthly class passes, and immersive retreat packages designed to support your daily movement practice.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-sub-tables-3"} /-->

<!-- wp:pattern {"slug":"lumina/team-3-people"} /-->

<!-- wp:pattern {"slug":"lumina/faq-2-columns"} /-->

<!-- wp:pattern {"slug":"lumina/call-to-action-2-columns"} /-->