<?php
/**
 * Title: Query Loop Sidebar Left
 * Description: Query Loop Sidebar Left
 * Slug: lumina/query-loop-sidebar-left
 * Categories: query
 * Block Types: core/query
 */
?>
<!-- wp:query {"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"displayLayout":{"type":"flex","columns":1},"layout":{"type":"constrained"},"lock":{"move":true,"remove":true}} -->
<div class="wp-block-query">

	<!-- wp:columns {"align":"wide","className":"main-content is-style-thick-gap","layout":{"type":"constrained"},"lock":{"move":true,"remove":true}} -->
	<div class="wp-block-columns alignwide main-content is-style-thick-gap">
	<!-- wp:column {"width":"340px","metadata":{"name":"Sidebar Column"},"lock":{"move":true,"remove":true}} -->
	<div class="wp-block-column" style="flex-basis:340px;">
		<!-- wp:template-part {"slug":"sidebar","theme":"lumina"} /-->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"style":{"spacing":{"margin":{"top":"0"}}},"lock":{"move":true,"remove":true}} -->
	<div class="wp-block-column" style="margin-top:0;">
	<!-- wp:post-template {"lock":{"move":true,"remove":true}} -->
		<!-- wp:template-part {"slug":"content-article","theme":"lumina"} /-->
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
	<!-- /wp:column -->
	
	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:query -->
