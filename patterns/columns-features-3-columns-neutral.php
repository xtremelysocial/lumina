<?php
/**
 * Title: Features 3 Columns
 * Slug: lumina/columns-features-3-columns-neutral
 * Categories: lumina, column, featured
 * Description: 3-column feature grid with circular icon badges and subtle background cards.
 */
?>
<!-- wp:group {"metadata":{"name":"Features 3 Columns"},"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"layout":{"type":"constrained"},"anchor":"features"} -->
<div class="wp-block-group alignfull" id="features" style="padding-right:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
    
    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        
        <!-- wp:column {"className":"is-style-rounded-border"} -->
        <div class="wp-block-column is-style-rounded-border">
            
            <!-- wp:icon {"icon":"core/arrow-right","align":"center","className":"is-style-round","backgroundColor":"primary-subtle","style":{"dimensions":{"width":"64px"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"margin":{"bottom":"var:preset|spacing|30"}}}} /-->

            <!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}},"anchor":"kinetic-physics"} -->
            <h3 class="wp-block-heading has-text-align-center" id="kinetic-physics"><?php esc_html_e( 'Interactive Cards', 'lumina' ); ?></h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"fontSize":"small"} -->
            <p class="has-text-align-center has-small-font-size"><?php esc_html_e( 'Container blocks carrying links or action buttons automatically respond with subtle lift and soft ambient shadows when hovered or tapped on mobile screens.', 'lumina' ); ?> <a href="#content-start"><?php esc_html_e( 'Learn more →', 'lumina' ); ?></a></p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"is-style-rounded-border"} -->
        <div class="wp-block-column is-style-rounded-border">
            
            <!-- wp:icon {"icon":"core/styles","align":"center","className":"is-style-round","backgroundColor":"secondary-subtle","style":{"dimensions":{"width":"64px"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"margin":{"bottom":"var:preset|spacing|30"}}}} /-->

            <!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}},"anchor":"chromatic-system"} -->
            <h3 class="wp-block-heading has-text-align-center" id="chromatic-system"><?php esc_html_e( 'Nature-Inspired Colors', 'lumina' ); ?></h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"fontSize":"small"} -->
            <p class="has-text-align-center has-small-font-size"><?php esc_html_e( 'Colors drawn from physical surroundings rather than harsh monitors. Rich earthy mid-tones and dark accents give you complete flexibility to direct visitor focus.', 'lumina' ); ?> <a href="#content-start"><?php esc_html_e( 'Learn more →', 'lumina' ); ?></a></p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"is-style-rounded-border"} -->
        <div class="wp-block-column is-style-rounded-border">
            
            <!-- wp:icon {"icon":"core/desktop","align":"center","className":"is-style-round","backgroundColor":"tertiary-subtle","style":{"dimensions":{"width":"64px"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"margin":{"bottom":"var:preset|spacing|30"}}}} /-->

            <!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}},"anchor":"fse-engine"} -->
            <h3 class="wp-block-heading has-text-align-center" id="fse-engine"><?php esc_html_e( 'Full Site Editing', 'lumina' ); ?></h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"fontSize":"small"} -->
            <p class="has-text-align-center has-small-font-size"><?php esc_html_e( 'Swap site headers, personalized footers, post grids, and color schemes directly within the Site Editor. Easily keep your site modern and fresh without writing code.', 'lumina' ); ?> <a href="#content-start"><?php esc_html_e( 'Learn more →', 'lumina' ); ?></a></p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->