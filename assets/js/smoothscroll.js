/**
 * File:	smoothscroll.js
 * Theme: 	Flat Blocks / Lumina
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
		 * Calculate fixed header height & update CSS variable
		 */
		var topOffset = 0;

		function updateHeaderHeight() {
			const fixedHeader = $('.wp-site-blocks > :first-child').filter('.is-style-fixed-header, :has(.is-style-fixed-header)');
			const stickyHeader = $('.wp-site-blocks > :first-child').filter('.is-position-sticky, :has(.is-position-sticky)');
			const adminBar = $('#wpadminbar');

			var headerHeight = 0;
			if (fixedHeader.length > 0) { 
				headerHeight = fixedHeader.outerHeight();
			} else if (stickyHeader.length > 0) {
				headerHeight = stickyHeader.outerHeight();
			}

			// Write --header-height to root (CSS handles scroll-padding and cover math)
// 			document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
			document.body.style.setProperty('--header-height', headerHeight + 'px');

			// Combined offset used strictly for jQuery scroll animation destination
			topOffset = headerHeight + (adminBar.length > 0 ? adminBar.outerHeight() : 0);
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

					var destination = target.offset().top - topOffset;

					// Respect OS-level reduced motion preference (instant jump)
					if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
						window.scrollTo(0, destination);
						return;
					}

					// Floor starts at duration--medium (~500ms), ceiling allowed up to 1800ms
					var minDuration = getCssDuration('--wp--custom--animation--duration--medium', 500);
					var maxDuration = 1800; // Gives long scrolls time to travel smoothly

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