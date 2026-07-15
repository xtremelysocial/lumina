/**
 * File:        lumina-physics.js
 * Theme:       Lumina Blocks
 *
 * Javascript for turning cards with a single link or button into a click target.
 *
 * @package lumina
 * @since   1.0
 */
 
( function( $ ) {
	
	$(document).ready(function() {

//		/* 
//		 * HEADLINE UNDERLINES: Add class to continue after click
//		 */
		 
// 		// Define the heading link selectors
// 		const headingLinks = '.wp-block-heading a, .wp-block-site-title a, .wp-block-post-title a, .wp-block-latest-posts.is-grid .wp-block-latest-posts__post-title';
// 		
// 		// Slap the loading state class on the clicked link right before page unload
// 		$(headingLinks).on('click', function() {
// 			$(this).addClass('is-loading');
// 		});

		/*
		 * DETAIL OPEN / CLOSE: Retains user setting
		 */

		// Retain open/closed state of HTML details blocks using localStorage
		$( 'details' ).each( function( index ) {
			const $details = $( this );
			
			// 1. Resolve a unique identifier for this element
			const elementIdentifier = $details.attr( 'id' ) || $details.closest( '[id]' ).attr( 'id' ) || 'global';
			
			// 2. Scope the storage key to the current page path so states don't bleed
			const pagePath   = window.location.pathname.replace( /[^a-zA-Z0-9]/g, '_' );
			const storageKey = 'details_state_' + pagePath + '_' + elementIdentifier + '_' + index;
		
			// 3. RESTORE STATE: Check if a saved preference exists on page load
			const savedState = localStorage.getItem( storageKey );
			if ( savedState !== null ) {
				$details.prop( 'open', savedState === 'open' );
			}
		
			// 🚀 HASH DETECTOR OVERRIDE: 
			// If the URL has a hash (e.g., #respond) and that target element is inside this details block, force it open!
			if ( window.location.hash ) {
				try {
					const $targetElement = $details.find( window.location.hash );
					if ( $targetElement.length > 0 ) {
						$details.prop( 'open', true );
					}
				} catch (e) {
					// Defensive catch in case the hash contains invalid selector characters
					console.warn("Invalid URL hash selector skipped", e);
				}
			}
		
			// 4. SAVE STATE: Listen for the native HTML toggle event
			$details.on( 'toggle', function() {
				localStorage.setItem( storageKey, this.open ? 'open' : 'closed' );
			} );
		} );

		// Retain open/closed state of HTML details blocks using localStorage
// 		$( 'details' ).each( function( index ) {
// 			const $details = $( this );
// 			
// 			// 1. Resolve a unique identifier for this element
// 			// Looks for details ID first, then falls back to the closest parent ID, then a default string
// 			const elementIdentifier = $details.attr( 'id' ) || $details.closest( '[id]' ).attr( 'id' ) || 'global';
// 			
// 			// 2. Scope the storage key to the current page path so states don't bleed across different posts/pages
// 			const pagePath   = window.location.pathname.replace( /[^a-zA-Z0-9]/g, '_' );
// 			const storageKey = 'details_state_' + pagePath + '_' + elementIdentifier + '_' + index;
// 		
// 			// 3. RESTORE STATE: Check if a saved preference exists on page load
// 			const savedState = localStorage.getItem( storageKey );
// 			if ( savedState !== null ) {
// 				$details.prop( 'open', savedState === 'open' );
// 			}
// 		
// 			// 4. SAVE STATE: Listen for the native HTML toggle event
// 			$details.on( 'toggle', function() {
// 				localStorage.setItem( storageKey, this.open ? 'open' : 'closed' );
// 			} );
// 		} );

		/*
		 * If an animated card only has one link or one button, then link the 
		 * entire card.
		 */
	
		// 1. INITIALIZATION: Set the cursor for everything that qualifies
		const $interactiveCards = $('[class*="wp-block-"]:is(.has-background, .is-style-rounded-border, .is-style-thick-rounded-border, .is-style-rounded-corners, .wp-block-cover):not(.alignfull)');

		// 2. GET TARGET: Returns the target link/button if the card is "valid"
		function getValidTarget($card) {
			if ($card.find('form, input:not([type="hidden"]), textarea, select').length > 0) {
				return null;
			}
		
			var $buttons = $card.find('.wp-element-button');
			var $links = $card.find('a').not('.wp-element-button');
			
			if ($buttons.length === 1 && $links.length === 0) return $buttons.first();
			if ($buttons.length === 0 && $links.length === 1) return $links.first();
			
			return null;
		}

		// 3. CURSOR: Set only if the helper finds a valid target
		$interactiveCards.each(function() {
			if (getValidTarget($(this)) !== null) {
				$(this).css('cursor', 'pointer');
			}
		});
	
		// 4. ACTION: Clean click/navigation listener
		$interactiveCards.on('click', function(e) {
			
			// If the user clicked a real interactive element inside, let it go natively
			if ($(e.target).closest('button, a, .wp-element-button, input, select').length) {
				return;
			}
	
			var $target = getValidTarget($(this));
	
			if ($target !== null) {
				
				// Kill the parent card highlight state immediately
				e.preventDefault();
				e.stopPropagation();
	
				if ($target.is('a')) {
					var href = $target.attr('href');
					var targetAttr = $target.attr('target');

					if (href) {
						var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

						if (isAnchor) {
							// Pass control over to smoothscroll.js exactly like a native link click
							$target.trigger('click');

							// SAFETY VALVE: If the user moves their wheel or touches the screen mid-scroll,
							// instantly kill the running animation so it never fights their manual input.
							$('html, body').one('wheel mousewheel touchmove DOMMouseScroll mousedown', function() {
								$('html, body').stop();
							});
						} else if (targetAttr === '_blank') {
							window.open(href, '_blank');
						} else {
							window.location.href = href;
						}
					}
				} else {
					$target[0].click();
				}
			}
		});
	});
	
} )( jQuery );