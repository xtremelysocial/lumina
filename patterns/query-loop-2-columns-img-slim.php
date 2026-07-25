<?php
/**
 * Title: Query Loop 2 Columns
 * Description: Query Loop 2 Columns Slim Image
 * Slug: lumina/query-loop-2-columns-img-slim
 * Categories: query
 * Block Types: core/query
 */
?>
<!-- wp:query {"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","categoryIds":[],"tagIds":[],"order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"displayLayout":{"type":"flex","columns":2},"layout":{"type":"constrained"},"lock":{"move":true,"remove":true}} -->
<div class="wp-block-query alignwide">

	<!-- wp:post-template {"align":"wide","lock":{"move":true,"remove":true}} -->
		<!-- wp:template-part {"slug":"content-article-img-slim","theme":"lumina"} /-->
	<!-- /wp:post-template -->

<!-- wp:group {"lock":{"move":true,"remove":true},"metadata":{"name":"Query Pagination"},"className":"is-style-no-padding","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group is-style-no-padding">
		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"lock":{"move":true,"remove":true}} -->
			<!-- wp:query-pagination-previous {"lock":{"move":true,"remove":true}} /-->
			<!-- wp:query-pagination-numbers {"lock":{"move":true,"remove":true}} /-->
			<!-- wp:query-pagination-next {"lock":{"move":true,"remove":true}} /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:group -->
	
	<!-- wp:query-no-results {"lock":{"move":false,"remove":true}} -->
	<!-- wp:pattern {"slug":"lumina/hidden-no-results"} /-->
	<!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->
