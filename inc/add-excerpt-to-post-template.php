<?php 
add_action( 'init', function() {
    foreach ( array( 'post', 'page' ) as $post_type ) {
        $post_type_object = get_post_type_object( $post_type );
        
        if ( $post_type_object ) {
            // Automatically seed the canvas with native core blocks
            $post_type_object->template = array(
                array( 'core/post-excerpt', array( 
                    'placeholder' => 'Write a brief, compelling summary here...',
                ) ),
                array( 'core/paragraph', array( 
                    'placeholder' => 'Begin typing your content here...' 
                ) )
            );
        }
    }
} );