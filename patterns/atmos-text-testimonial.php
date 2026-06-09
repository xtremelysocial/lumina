<?php
/**
 * Title: Atmos Text Testimonial
 * Slug: atmos-blocks/atmos-text-testimonial
 * Categories: atmos
 */
?>
<!-- wp:group {"align":"wide","backgroundColor":"secondary-alt","className":"is-style-rounded-border","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-rounded-border has-secondary-alt-background-color has-background" id="quote-large">
	<!-- wp:image {"align":"center","width":80,"height":80,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
	<figure class="wp-block-image aligncenter size-full is-resized is-style-rounded">
		<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/person-male.jpg' ) ); ?>" alt="" width="80" height="80"/>
	</figure>
	<!-- /wp:image -->

	<!-- wp:quote {"textAlign":"center","className":"is-style-plain"} -->
	<blockquote class="wp-block-quote has-text-align-center is-style-plain">
		<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
		<p class="has-text-align-center has-large-font-size"><em>"The attention to detail in the design and the seamless functionality of the blocks have completely transformed our workflow."</em></p>
		<!-- /wp:paragraph -->
		<cite>— John Doe, <em>Customer</em></cite>
	</blockquote>
	<!-- /wp:quote -->
</div>
<!-- /wp:group -->
