<?php
/**
 * Title: Columns Recent Posts 3 Columns
 * Description: Columns Recent Posts 3 Columns
 * Slug: lumina/columns-recent-posts-3-columns
 * Categories: lumina, column
 * Block Types: core/columns
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" id="latest-posts" style="padding-bottom:0px"><!-- wp:heading {"textAlign":"left","align":"wide"} -->
<h2 class="wp-block-heading alignwide has-text-align-left" id="our-recent-posts"><?php esc_html_e("Recent Posts", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"className":"is-style-default","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide is-style-default" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"align":"left"} -->
<p class="has-text-align-left"><?php esc_html_e("Recent posts from the blog...", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"right","className":"is-style-link-no-underline"} -->
<p class="has-text-align-right is-style-link-no-underline"><a href="/blog/">&gt; See All Posts</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"is-style-default"} -->
<div class="wp-block-group alignwide is-style-default"><!-- wp:latest-posts {"postsToShow":3,"displayPostContent":true,"excerptLength":20,"postLayout":"grid","displayFeaturedImage":true,"featuredImageAlign":"center","featuredImageSizeSlug":"cropped-thumbnail","addLinkToFeaturedImage":true,"align":"wide"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->