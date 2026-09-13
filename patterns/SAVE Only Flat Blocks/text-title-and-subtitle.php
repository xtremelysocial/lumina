<?php
/**
 * Title: Text Title And Subtitle
 * Description: Text Title And Subtitle
 * Slug: lumina/text-title-and-subtitle
 * Categories: lumina, text
 * Block Types: core/paragraph
 */
?>
<!-- wp:group {"metadata":{"categories":["lumina","text","banner"],"patternName":"lumina/text-title-and-subtitle","name":"Title and Subtitle"},"align":"full","className":"entry-header","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull entry-header has-primary-background-color has-background" id="title-and-subtitle" style="margin-top:0;margin-bottom:0"><!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"placeholder":"Title","align":"wide","className":"wp-block-post-title"} -->
<h2 class="wp-block-heading alignwide wp-block-post-title" id="title"><?php esc_html_e("Title", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"placeholder":"Subtitle","className":"entry-subtitle is-style-alignwide","fontSize":"medium"} -->
<p class="entry-subtitle is-style-alignwide has-medium-font-size"><?php esc_html_e("Subtitle", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->