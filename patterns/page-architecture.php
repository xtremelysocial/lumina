<?php
/**
 * Title: Sample Architecture Page
 * Slug: lumina/page-architecture
 * Categories: lumina, page
 * Block Types: core/post-content
 * Description: An architectural studio template featuring immersive pan-and-zoom heroes, editorial philosophy columns, project showcases, and studio metrics.
 */
?>

<!-- wp:pattern {"slug":"lumina/cover-scroll-home-header"} /-->

<!-- wp:pattern {"slug":"lumina/drop-caps-2-columns"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"featured-commissions"} -->
	<h2 class="wp-block-heading is-style-separator" id="featured-commissions"><?php esc_html_e("Featured Commissions", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("A curated selection of residential spaces, timber structures, and commercial restorations shaped by natural light and site-specific topography.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/image-left-and-right-text"} /-->

<!-- wp:pattern {"slug":"lumina/image-gallery-no-gap"} /-->

<!-- wp:pattern {"slug":"lumina/columns-intro+3x2-dividers"} /-->

<!-- wp:pattern {"slug":"lumina/static-map-and-contact-info-card"} /-->