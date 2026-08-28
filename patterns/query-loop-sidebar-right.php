<?php
/**
 * Title: Lumina Query Loop Sidebar Right
 * Description: Query Loop Sidebar Right
 * Slug: lumina/query-loop-sidebar-right
 * Categories: lumina, query
 * Block Types: core/query
 */
?>
<!-- wp:query {"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","categoryIds":[],"tagIds":[],"order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"displayLayout":{"type":"flex","columns":1},"layout":{"type":"constrained"},"lock":{"move":true,"remove":true}} -->
<div class="wp-block-query">

	<!-- wp:columns {"align":"wide","className":"main-content is-style-thick-gap","layout":{"type":"constrained"},"lock":{"move":true,"remove":true}} -->
	<div class="wp-block-columns alignwide main-content is-style-thick-gap">
		<!-- wp:column {"className":"content-column","style":{"spacing":{"margin":{"top":"0"}}},"lock":{"move":true,"remove":true}} -->
		<div class="wp-block-column content-column" style="margin-top:0;">
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

		<!-- wp:column {"className":"sidebar-column","width":"var(--wp--custom--sidebar--width)","metadata":{"name":"Sidebar Column"},"lock":{"move":true,"remove":true}} -->
		<div class="wp-block-column sidebar-column" style="flex-basis:var(--wp--custom--sidebar--width);">
			<!-- wp:template-part {"slug":"sidebar","theme":"lumina","lock":{"move":true,"remove":true}} /-->
		</div>
		<!-- /wp:column -->
		
	</div>
	<!-- /wp:columns -->
	
</div>
<!-- /wp:query -->
