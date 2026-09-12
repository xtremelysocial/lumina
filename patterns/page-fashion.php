<?php
/**
 * Title: Sample Fashion Page
 * Slug: lumina/page-fashion
 * Categories: lumina, page
 * Block Types: core/post-content
 * Description: An editorial fashion lookbook template featuring motion video headers, seasonal concept drops, and digital brand showcases.
 */
?>

<!-- wp:pattern {"slug":"lumina/banner-home-hero-media-text"} /-->

<!-- wp:pattern {"slug":"lumina/drop-caps-3-columns"} /-->

<!-- wp:pattern {"slug":"lumina/image-computer-screen"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"className":"is-style-separator","anchor":"seasonal-lookbook"} -->
	<h2 class="wp-block-heading is-style-separator" id="seasonal-lookbook"><?php esc_html_e("Autumn / Winter Lookbook", "lumina"); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php esc_html_e("Explore key silhouettes, organic linen textiles, and tailored outer layers from our latest capsule release.", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/image-gallery-rounded"} /-->

<!-- wp:pattern {"slug":"lumina/buttons-call-to-action-dark-full-width"} /-->