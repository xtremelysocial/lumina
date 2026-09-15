<?php
 /**
  * Title: Post Date (and Time to Read and Comment Count if available)
  * Slug: lumina/hidden-post-date
  * Categories: lumina, text
  * Inserter: false
  * Description: Display the Post Date and if WordPress v6.9+ or Gutenberg is active, 
  * also display the Time to Read and Comment Count
  */
?>

<!-- wp:post-date /-->

<?php if (
	( defined( 'IS_GUTENBERG_PLUGIN' ) && IS_GUTENBERG_PLUGIN )
	|| version_compare( get_bloginfo( 'version' ), '6.9', '>=' ) 
	) : ?>
		<!-- wp:post-time-to-read {"displayAsRange":false,"className":"is-style-default"} /-->
	<!-- wp:post-comments-link {"className":"is-style-link-inactive"} /-->
<?php endif;
