<?php
/**
 * Title: Lumina Hero Banner Dark w/Image
 * Slug: lumina/banner-dark-with-image
 * Categories: lumina, banner, image, featured
 * Block Types: core/group
 */

$theme_image_url = esc_url( get_theme_file_uri( 'assets/images/samples/image-city-night.webp' ) );
?>
<!-- wp:group {"align":"full","backgroundColor":"dark-alt","className":"","id":"lumina-hero-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-dark-alt-background-color has-background" id="lumina-hero-dark">
    
    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        
        <!-- wp:column {"width":"55%"} -->
        <div class="wp-block-column" style="flex-basis:55%">
            <!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.1"}},"fontSize":"xx-large"} -->
            <h1 class="wp-block-heading has-xx-large-font-size" style="line-height:1.1">Lumina WordPress Theme</h1>
            <!-- /wp:heading -->

            <!-- wp:heading {"level":2,"fontSize":"large"} -->
            <h2 class="wp-block-heading has-large-font-size">A modern evolution of full-site editing. Engineered with colors drawn from nature, ambient depth, and responsive interactive cards.</h2>
            <!-- /wp:heading -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var(--wp--preset--spacing--50)"}}}} -->
            <div class="wp-block-buttons is-layout-flex" style="margin-top:var(--wp--preset--spacing--50)">
                <!-- wp:button -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link wp-element-button" href="#content-start">Explore Framework</a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline"} -->
                <div class="wp-block-button is-style-outline">
                    <a class="wp-block-button__link wp-element-button" href="#features">View Features</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"45%"} -->
        <div class="wp-block-column" style="flex-basis:45%">
            <!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"full","className":"is-style-image-border"} -->
            <figure class="wp-block-image size-full is-style-image-border">
                <img src="<?php echo $theme_image_url; ?>" alt="Lumina Minimalist Canvas Showcase" style="aspect-ratio:16/9;object-fit:cover"/>
            </figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content Start"},"align":"full","className":"is-style-default","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-default" id="content-start" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->