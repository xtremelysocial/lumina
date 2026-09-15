<?php
 /**
  * Title: Index (Blog) Page Title
  * Slug: lumina/hidden-title-index
  * Categories: lumina, text
  * Inserter: false
  * Description: Index (Blog) page title as pattern so can allow for language translations
  */
?>

<!-- wp:heading {"level":1,"align":"wide","className":"entry-title wp-block-post-title","fontSize":"x-large"} -->
<h1 class="alignwide entry-title has-x-large-font-size wp-block-post-title" id="index-title"><?php echo __("Blog", "lumina"); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"entry-subtitle is-style-separator","fontSize":"medium"} -->
<p class="entry-subtitle is-style-separator has-medium-font-size"><?php echo __("Our blog posts", "lumina"); ?></p>
<!-- /wp:paragraph -->
