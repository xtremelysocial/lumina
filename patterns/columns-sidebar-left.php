<?php
/**
 * Title: Columns Sidebar Left
 * Description: Columns Sidebar Left
 * Slug: lumina/columns-sidebar-left
 * Categories: lumina, column
 * Block Types: core/columns
 */
?>
<!-- wp:columns {"metadata":{"name":"Content with Left Sidebar"},"align":"wide","className":"is-style-thick-gap"} -->
<div class="wp-block-columns alignwide is-style-thick-gap" id="sidebar-left">
<!-- wp:column {"width":"340px","metadata":{"name":"Sidebar Column"},"lock":{"move":true,"remove":true}} -->
<div class="wp-block-column" style="flex-basis:340px;">
<!-- wp:group {"metadata":{"name":"Sidebar Group"},"className":"sidebar is-style-rounded-border"} -->
<div class="wp-block-group sidebar is-style-rounded-border">
<!-- wp:heading {"level":3,"placeholder":"Sidebar"} -->
<h3 class="wp-block-heading" id="sidebar"><?php esc_html_e("Sidebar", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p class=""><?php esc_html_e("Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"metadata":{"name":"Content Column"},"style":{"spacing":{"margin":{"top":"0"}}}} -->
<div class="wp-block-column" style="margin-top:0"><!-- wp:paragraph -->
<p class=""><?php esc_html_e("Lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->