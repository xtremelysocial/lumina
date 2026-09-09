<?php
/**
 * Title: Sample About Page
 * Slug: lumina/page-about
 * Categories: lumina, page
 * Block Types: core/post-content
 * Description: An editorial About page featuring brand narrative, core values, team grid, and client social proof.
 */
?>

<!-- wp:pattern {"slug":"lumina/banner-hero-media-text"} /-->

<!-- wp:pattern {"slug":"lumina/columns-site-motto-details"} /-->

<!-- wp:pattern {"slug":"lumina/columns-features-3-columns"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"our-team"} -->
	<h2 class="wp-block-heading is-style-separator" id="our-team"><?php esc_html_e("Meet Our Team", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("The creative minds, systems architects, and detail-driven designers behind Lumina’s block patterns and color physics.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-team-4-people"} /-->

<!-- wp:pattern {"slug":"lumina/testimonial-with-avatar"} /-->

<!-- wp:pattern {"slug":"lumina/call-to-action-2-columns-dark"} /-->