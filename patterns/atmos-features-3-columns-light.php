<?php
/**
 * Title: Lumina Features 3 Columns (Light)
 * Slug: lumina/features-3-columns-light
 * Categories: lumina
 */
?>
<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" id="features-3-columns-light">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="has-text-align-center" id="features-3-columns-title">Features 3 Columns</h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
	<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"className":"is-style-rounded-border","backgroundColor":"neutral-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-column is-style-rounded-border has-neutral-alt-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
			<!-- wp:image {"align":"center","width":100,"height":100,"sizeSlug":"thumbnail","linkDestination":"#content-start","className":"is-style-rounded"} -->
			<figure class="wp-block-image aligncenter size-thumbnail is-resized is-style-rounded"><a href="#content-start"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/thumbnail-gears.jpg' ) ); ?>" alt="photo of golden cogwheel on black background" width="100" height="100"/></a></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"center","level":3} -->
			<h3 class="has-text-align-center" id="column-1">Lorem Ipsum</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"is-style-rounded-border","backgroundColor":"neutral-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-column is-style-rounded-border has-neutral-alt-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
			<!-- wp:image {"align":"center","width":100,"height":100,"sizeSlug":"thumbnail","linkDestination":"#content-start","className":"is-style-rounded"} -->
			<figure class="wp-block-image aligncenter size-thumbnail is-resized is-style-rounded"><a href="#content-start"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/thumbnail-hands.jpg' ) ); ?>" alt="crop psychologist supporting patient during counseling indoors" width="100" height="100"/></a></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"center","level":3} -->
			<h3 class="has-text-align-center" id="column-2">Dolor Sit Amet</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"is-style-rounded-border","backgroundColor":"neutral-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-column is-style-rounded-border has-neutral-alt-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
			<!-- wp:image {"align":"center","width":100,"height":100,"sizeSlug":"thumbnail","linkDestination":"#content-start","className":"is-style-rounded"} -->
			<figure class="wp-block-image aligncenter size-thumbnail is-resized is-style-rounded"><a href="#content-start"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/thumbnail-dollars.jpg' ) ); ?>" alt="pexels-photo-164661.jpeg" width="100" height="100"/></a></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"center","level":3} -->
			<h3 class="has-text-align-center" id="column-3">Duis Aute Irure</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->