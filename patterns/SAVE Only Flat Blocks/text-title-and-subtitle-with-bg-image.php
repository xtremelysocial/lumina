<?php
/**
 * Title: Text Title And Subtitle With Bg Image
 * Description: Text Title And Subtitle With Bg Image
 * Slug: lumina/text-title-and-subtitle-with-bg-image
 * Categories: lumina, media, text
 * Block Types: core/paragraph
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/samples/screenshots/01.webp" ) ); ?>","dimRatio":60,"minHeight":130,"minHeightUnit":"px","align":"full","anchor":"title-and-subtitle-with-background-image","style":{"spacing":{"margin":{"top":"0"}}}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;min-height:130px" id="title-and-subtitle-with-background-image"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/samples/screenshots/01.webp" ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide">
<!-- wp:heading {"anchor":"title","placeholder":"Title","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size" id="title"><?php esc_html_e("Title", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"placeholder":"Subtitle","fontSize":"medium"} -->
<p class="has-medium-font-size"><?php esc_html_e("Subtitle", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->