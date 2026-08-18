<?php
 /**
  * Title: Current Year
  * Slug: lumina/text-current-year
  * Categories: lumina, text
  * Inserter: false
  * viewportWidth: 760
  * Description: Current year (e.g. 2024)
  */

// Display the current year
echo sprintf( 
	'<!-- wp:paragraph --><p>%s</p>
<!-- /wp:paragraph -->',
	date( 'Y' )
);
