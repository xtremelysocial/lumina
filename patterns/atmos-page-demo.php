<?php
 /**
  * Title: Atmos Demo Page
  * Slug: atmos-blocks/page-demo
  * Categories: atmos, page
  * Block Types: core/post-content
  * Description: A full page demo for the Atmos child theme.
  */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|60"}}},"backgroundColor":"primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xxx-large"} -->
	<h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size">Atmos Design System</h1>
	<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"atmos-blocks/image-left-right-text"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:pattern {"slug":"atmos-blocks/dashboard-feature-grid"} /-->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"atmos-blocks/atmos-feature-stack"} /-->

<!-- wp:group {"align":"full","backgroundColor":"secondary","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-secondary-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:pattern {"slug":"atmos-blocks/social-4-columns"} /-->
</div>
<!-- /wp:group -->
