<?php
/**
 * Title: Lumina Text Site Copyright
 * Description: Text Site Copyright
 * Slug: lumina/text-site-copyright
 * Categories: lumina, text
 */
?>

<!-- wp:group {"metadata":{"name":"Site Copyright"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group">
<!-- wp:paragraph -->
<p>© </p>
<!-- /wp:paragraph -->

<?php
echo sprintf( 
	'<!-- wp:paragraph --><p>%s</p>
<!-- /wp:paragraph -->',
	date( 'Y' )
);
?>

<!-- wp:pattern {"slug":"lumina/text-site-title-paragraph"} /--></div>
<!-- /wp:group -->
