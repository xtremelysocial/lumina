/**
 * File:	smoothscroll.js
 * Theme: 	XtremelySocial Shared / Lumina Engine
 * 
 * Javascript for smooth scrolling internal links and updating dynamic 
 * CSS header offset variables.
 *
 * @package flat-blocks
 * @since	1.0
 */
 
( function( $ ) {
	
	$(document).ready(function() {

		// 1. Helper to read CSS duration tokens from :root into milliseconds
		function getCssDuration(varName, fallbackMs) {
			var val = getComputedStyle(document.documentElement).getPropertyValue(varName).trim();
			if (!val) return fallbackMs;
			if (val.indexOf('ms') !== -1) return parseFloat(val);
			if (val.indexOf('s') !== -1) return parseFloat(val) * 1000;
			return fallbackMs;
		}

		// 2. Sine ease-in-out: Immediate motion response on frame 1 + soft landing
		$.easing.luminaSmooth = function(p) {
			return 0.5 - Math.cos(p * Math.PI) / 2;
		};

		/*
		 * Calculate fixed & floating header heights & update CSS variables
		 */
		var topOffset = 0;

		function updateHeaderHeight() {
			const wrapper = $('.wp-site-blocks > :first-child');
			const headerEl = wrapper.find('.site-header').length ? wrapper.find('.site-header') : wrapper.filter('.site-header');
			const adminBar = $('#wpadminbar');

			var physicalHeight = 0;
			var headerOffsetForCover = 0;
			var adminBarHeight = adminBar.length > 0 ? adminBar.outerHeight() : 0;

			if (headerEl.length > 0) { 
				physicalHeight = headerEl.outerHeight();

				// STRICT CHECK: Only check if the actual INNER header card is full-width (.alignfull)
				const isFlushHeader = headerEl.hasClass('alignfull');

				if (isFlushHeader) {
					// Flush header sits above hero: Subtract height from Cover block
					headerOffsetForCover = physicalHeight;
					topOffset = physicalHeight + adminBarHeight;
				} else {
					// Floating header overlays hero: Cover starts at Y=0 and needs FULL 100vh
					headerOffsetForCover = 0;

					var computedTop = getComputedStyle(wrapper[0]).getPropertyValue('--header-top-offset').trim();
					var floatingOffset = parseFloat(computedTop) || 24;
					topOffset = physicalHeight + floatingOffset + adminBarHeight;
				}
			} else {
				topOffset = adminBarHeight;
			}

			// 1. Used by group.scss negative margin to pull <main> up to Y=0
			document.documentElement.style.setProperty('--header-rendered-height', physicalHeight + 'px');

			// 2. Used by Cover block math: 0px for floating (full 100vh bleed), actual px for flush headers
			document.documentElement.style.setProperty('--header-height', headerOffsetForCover + 'px');
		}

		// Run once on load and update on window resize / orientation change
		updateHeaderHeight();
		$(window).on('resize orientationchange', updateHeaderHeight);
		
		const links = $('a[href*="#"]')
			.not('[href="#"]')
			.not('[href="#0"]')
			.not('[data-toggle="tab"]')
			.not('[data-toggle="collapse"]');

		// When clicked, smoothly scroll to the element
		links.click(function(event) {
			if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
				&& 
				location.hostname == this.hostname
			) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					event.preventDefault();

					var destination = Math.max(0, target.offset().top - topOffset);

					// Respect OS-level reduced motion preference (instant jump)
					if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
						window.scrollTo(0, destination);
						return;
					}

					// Floor starts at duration--medium (~500ms), ceiling allowed up to 1800ms
					var minDuration = getCssDuration('--wp--custom--animation--duration--medium', 500);
					var maxDuration = 1800;

					var distance = Math.abs($(window).scrollTop() - destination);
					var calculated = minDuration + (distance * 0.45);
					var duration = Math.min(maxDuration, Math.max(minDuration, calculated));

					$('html, body').animate({
						scrollTop: destination
					}, duration, 'luminaSmooth');
				}
			}
		});
					
	});
	
} )( jQuery );
