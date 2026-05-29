<?php
/**
 * File:		pro-default-image.php
 * Theme:		Flat Blocks PRO
 * 
 * Load a default post featured image when there isn't one
 * 
 * @package 	flat-blocks-pro
 */

/**
 * Set a default post featured image if there isn't one already
 */
add_filter( 'post_thumbnail_html', 'flatblocks_pro_filter_post_thumbnail_html', 10, 5 );

if ( ! function_exists('flatblocks_pro_filter_post_thumbnail_html') ) :
 
	function flatblocks_pro_filter_post_thumbnail_html( 
		$html, 
		$pid, 
		$post_thumbnail_id, 
		$size, 
		$attr 
	) {

		/* If no post featured image, but there is a post, then set the default image */
		if ( ! $html && $pid ) {
// 			$default_image = get_template_directory_uri() . '/assets/images/image-lines-blue.jpg';

			// Use the last digit of the post id to determine the image to use
			$path = '/assets/images/';
			$images = ['cover-bokeh.jpg', 'cover-book.jpg', 'cover-building.jpg', 'cover-camera.jpg', 'cover-city-night.jpg', 'cover-colored-blocks', 'cover-colored-chalk.jpg', 'cover-desk-dark.jpg', 'cover-desk-dark.jpg', 'cover-desk-meeting.jpg'];
			$last_digit = $pid % count($images);
			$image = $images[$last_digit];
			$default_image = get_template_directory_uri() . $path . $image;
// 			$default_image = get_stylesheet_directory_uri() . $path . $image;

			$default_image = apply_filters( 'flatblocks_default_image_url', $default_image, $pid );

			$image_alt = esc_attr( get_the_title( $pid ) );
			$image_alt = apply_filters( 'flatblocks_default_image_alt', $image_alt, $pid );
			
			$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
			
			//preg_match( '/max-width\:(.*)px/', $attr['style'], $dimensions );
			preg_match( "/max-width:(\\d+).*max-height:(\\d+)/", $attr['style'], $dimensions);
			$image_dimensions = $dimensions ? "width={$dimensions[1]} height={$dimensions[2]}" : '';
// 			$image_dimensions = $dimensions ? "width={$dimensions[1]} height={$dimensions[2]}" : 'width="1600" height: "900"';
			
			$image_style = $attr['style'] ? $attr['style'] : '';
			$image_style .= $dimensions ? "width:{$dimensions[1]}px;height:{$dimensions[2]}px;" : '';
			
			$html = sprintf(
				'<img src="%s" alt="%s" class="%s" style="%s" %s />',
				$default_image,
				$image_alt,
				$image_class,
				$image_style,
				$image_dimensions
			);
		}

		return $html;
	}

endif;

/**
  * Also make sure that has_post_thumbnail always returns true so the above actually
  * gets called.
  */
add_filter( 'has_post_thumbnail', 'flatblocks_pro_has_post_thumbnail', 10, 3 );
if ( ! function_exists('flatblocks_pro_has_post_thumbnail') ) :

	function flatblocks_pro_has_post_thumbnail( $has_thumbnail, $post, $thumbnail_id ) {
	
		$has_thumbnail = true; 
		return $has_thumbnail; 
	}

endif;