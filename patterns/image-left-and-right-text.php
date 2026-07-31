<?php
/**
 * Title: Lumina Image with Left and Right Text
 * Slug: lumina/image-left-and-right-text
 * Categories: lumina, image
 */
?>
<!-- wp:group {"align":"wide","className":"is-style-rounded-border","backgroundColor":"primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-rounded-border has-primary-background-color has-background" id="image-with-left-and-right-text">
	
	<!-- wp:heading {"textAlign":"center","level":2} -->
	<h2 class="wp-block-heading has-text-align-center">Featured Spotlight</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
	<div class="wp-block-columns alignwide">
		
		<!-- wp:column {"width":"25%"} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:heading {"level":4} -->
			<h4 class="wp-block-heading">Core Mechanics</h4>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Explore the intricate details of modern hardware and design. Every component is built for precision and tactile response.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%">
			<!-- wp:image {"align":"center","sizeSlug":"large","className":"is-style-rounded-border"} -->
			<figure class="wp-block-image aligncenter size-large is-style-rounded-border">
				<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/samples/image-city-night.webp' ) ); ?>" alt="Modern hardware design" />
			</figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"25%"} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:heading {"level":4} -->
			<h4 class="wp-block-heading">Refined Finish</h4>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>A focus on matte textures and industrial materials ensures a premium look that fits into any professional environment.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
