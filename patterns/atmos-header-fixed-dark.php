<?php
/**
 * Title: Atmos Dark Fixed Header
 * Description: Dark header fixed to the top of the site
 * Slug: atmos-blocks/atmos-header-fixed-dark
 * Categories: header
 * Block Types: core/template-part/header 
 */
?>
<!-- wp:group {"tagName":"header","metadata":{"name":"Header"},"align":"full","className":"site-header is-position-sticky","style":{"position":{"type":"sticky","top":"0px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"bottom":{"color":"var:preset|color|dark-alt","width":"1px"},"top":{},"right":{},"left":{}}},"backgroundColor":"dark","layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull site-header is-position-sticky has-dark-background-color has-background" style="border-bottom-color:var(--wp--preset--color--dark-alt);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"wide","className":"is-style-default","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
<div class="wp-block-group alignwide is-style-default">
<!-- wp:group {"className":"is-style-default","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group is-style-default">
<!-- wp:site-logo {"width":64} /-->

<!-- wp:site-title /--></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-default","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group is-style-default">
<!-- wp:template-part {"slug":"menu-header-dark"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></header>
<!-- /wp:group -->
