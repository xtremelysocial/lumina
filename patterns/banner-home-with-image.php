<?php
/**
 * Title: Lumina Home Page Hero Banner w/Image
 * Slug: lumina/banner-home-with-image
 * Categories: lumina, banner, image, featured
 * Block Types: core/group
 */
?>

<!-- wp:group {"align":"full","backgroundColor":"dark-alt","className":"","id":"lumina-hero-home","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-dark-alt-background-color has-background" id="lumina-hero-home">
    
    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        
        <!-- wp:column {"width":"55%"} -->
        <div class="wp-block-column" style="flex-basis:55%">

            <!-- wp:site-title {"level":1,"isLink":false,"style":{"typography":{"lineHeight":"1.1"}},"fontSize":"xx-large"} /-->

            <!-- wp:site-tagline {"level":2,"fontSize":"large","style":{"spacing":{"margin":{"top":"var(--wp--preset--spacing--30)"}}}} /-->

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

			<!-- wp:template-part {"slug":"featured-image-wide","align":"wide","lock":{"move":true,"remove":true}} /-->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content Start"},"align":"full","className":"is-style-default","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-default" id="content-start" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->