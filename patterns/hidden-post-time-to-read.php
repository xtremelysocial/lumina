<?php
 /**
  * Title: Post Time to Read (if WordPress 6.9+ or Gutenberg Plugin active)
  * Slug: lumina/hidden-post-time-to-read
  * Categories: lumina, text
  * Inserter: false
  * Description: Display the Post Time to Read block if Gutenberg is active or WordPress
  * version is >= 6.9.
  */
?>

<?php if (
	( defined( 'IS_GUTENBERG_PLUGIN' ) && IS_GUTENBERG_PLUGIN )
	|| version_compare( get_bloginfo( 'version' ), '6.9', '>=' ) 
	) : ?>
		<!-- wp:post-time-to-read {"displayAsRange":false,"className":"is-style-default"} /-->
<?php endif;
