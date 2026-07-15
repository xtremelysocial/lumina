/**
 * File: inline-excerpt.js
 * Binds a canvas text control to the native post excerpt entity.
 */
( function( blocks, element, data, coreData, components ) {
    var el = element.createElement;
    var useSelect = data.useSelect;
    var useEntityProp = coreData.useEntityProp;
    var TextareaControl = components.TextareaControl;

    blocks.registerBlockType( 'lumina/inline-excerpt', {
        title: 'Summary / Excerpt Input',
        icon: 'editor-alignleft',
        category: 'theme',
        supports: { 
            multiple: false, 
            html: false, 
            reorder: false 
        },
        edit: function() {
            var postType = useSelect( function( select ) {
                return select( 'core/editor' ).getCurrentPostType();
            }, [] );

            var entityProp = useEntityProp( 'postType', postType, 'excerpt' );
            var excerpt = entityProp[0];
            var setExcerpt = entityProp[1];

            return el(
                'div',
                { className: 'lumina-inline-excerpt-editor' },
                el( TextareaControl, {
                    label: 'Inline Post Excerpt',
                    value: excerpt || '',
                    placeholder: 'Write a brief summary here (Updates your header template part)...',
                    onChange: function( value ) { 
                        setExcerpt( value ); 
                    }
                } )
            );
        },
        save: function() { 
            return null; // Keeps the database body text string completely pure
        }
    } );
} )( window.wp.blocks, window.wp.element, window.wp.data, window.wp.coreData, window.wp.components );