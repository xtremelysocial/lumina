<?php
/**
 * Title: Cover Scroll Static Image
 * Description: Cover Scroll Static Image
 * Slug: lumina/cover-scroll-static-image
 * Categories: lumina, banner, media
 * Block Types: core/cover
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>","dimRatio":30,"isUserOverlayColor":true,"minHeight":480,"sizeSlug":"large","metadata":{"name":"Cover Scroll Static Image"},"align":"full","className":"is-dark is-style-pan-zoom","style":{"spacing":{"margin":{"top":"0"}}},"anchor":"cover-scroll-static-image"} -->
<div class="wp-block-cover alignfull is-dark is-style-pan-zoom" style="margin-top:0;min-height:480px" id="cover-scroll-static-image"><img class="wp-block-cover__image-background size-large" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container">

	<!-- wp:group {"align":"wide","className":"is-style-glass is-style-static"} -->
	<div class="wp-block-group alignwide is-style-glass is-style-static">

		<!-- wp:heading {"placeholder":"Cover Image Title","fontSize":"huge","anchor":"title"} -->
<h2 id="title" class="wp-block-heading has-huge-font-size"><?php esc_html_e("Fine Art & Visual Studio", "lumina"); ?></h2>
<!-- /wp:heading -->

		<!-- wp:paragraph {"metadata":{"name":"Subtitle"},"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large","anchor":"subtitle"} -->
<p class="has-x-large-font-size" id="subtitle" style="line-height:1.2"><?php esc_html_e("Capturing light, depth, and story", "lumina"); ?></p>
<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2","textAlign":"center"}},"fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size" style="line-height:1.2"><?php esc_html_e("Tailored visual storytelling and studio photography that transform moments into timeless imagery with intentional composition.", "lumina"); ?></p>
<!-- /wp:paragraph -->

		<!-- wp:pattern {"slug":"lumina/text-scroll-down"} /-->
	</div>
	<!-- /wp:group -->

</div></div>
<!-- /wp:cover -->

<!-- wp:pattern {"slug":"lumina/hidden-content-start"} /-->