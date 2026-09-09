<?php
/**
 * Title: Sample Artisan Page
 * Slug: lumina/page-artisan
 * Categories: lumina, page
 * Block Types: core/post-content
 * Description: An organic craft atelier page featuring pottery, hand-thrown ceramics, and studio storytelling.
 */
?>

<!-- wp:pattern {"slug":"lumina/cover-scroll-static-image"} /-->

<!-- wp:pattern {"slug":"lumina/columns-site-motto-details"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"studio-collection"} -->
	<h2 class="wp-block-heading is-style-separator" id="studio-collection"><?php esc_html_e("The Atelier Collection", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("Small-batch ceramics, hand-carved tableware, and stoneware vessels fired locally using natural glazes.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/image-gallery"} /-->

<!-- wp:pattern {"slug":"lumina/columns-features-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/testimonial-with-avatar"} /-->

<!-- wp:pattern {"slug":"lumina/static-map-and-contact-info-full"} /-->