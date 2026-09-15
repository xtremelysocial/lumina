<?php
/**
 * Title: Blog Index Intro
 * Description: Blog Index Intro (for when that is set as the home page on the site)
 * Slug: lumina/text-blog-index-intro
 * Categories: lumina, text
 * Block Types: core/group
 */
?>
<!-- wp:group {"metadata":{"name":"Blog Index Intro"},"align":"wide","layout":{"type":"constrained"},"anchor":"columns-3-recent-posts"} -->
<div class="wp-block-group alignwide" id="columns-3-recent-posts"><!-- wp:heading {"align":"wide","style":{"typography":{"textAlign":"left"}},"anchor":"our-recent-posts"} -->
<h2 class="wp-block-heading has-text-align-left alignwide" id="blog-index-intro"><?php esc_html_e("Our Blog", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","className":"is-style-default","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide is-style-default" style="margin-top:var(--wp--preset--spacing--30)">
<!-- wp:paragraph {"style":{"typography":{"textAlign":"left"}}} -->
<p class="has-text-align-left"><?php esc_html_e("Catch up on posts from our blog...", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->