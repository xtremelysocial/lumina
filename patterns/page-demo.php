<?php
 /**
  * Title: Lumina Demo Page
  * Slug: lumina/page-demo
  * Categories: lumina, page
  * Block Types: core/post-content
  * Description: A full page demo for the Lumina child theme.
  */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|60"}}},"backgroundColor":"primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xxx-large"} -->
	<h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size">Lumina Design System</h1>
	<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/image-left-and-right-text"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:pattern {"slug":"lumina/columns-dashboard-feature-grid"} /-->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/columns-feature-stack-light"} /-->

<!-- wp:group {"align":"full","backgroundColor":"secondary","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-secondary-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:pattern {"slug":"lumina/columns-social-4-columns"} /-->
</div>
<!-- /wp:group -->
