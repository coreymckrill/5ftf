window.wp = window.wp || {};

jQuery( function( $ ) {
	'use strict';

	var communityEventsData = window.communityEventsData || {},
		app;


	/**
	 * Global Community Events namespace.
	 *
	 * @since 4.8.0
	 *
	 * @memberOf wp
	 * @namespace wp.communityEvents
	 */
	app = window.wp.communityEvents = {
		initialized: false,
		model: null,

		/**
		 * Initializes the wp.communityEvents object.
		 *
		 * @since 4.8.0
		 *
		 * @returns {void}
		 */
		init: function() {
			if ( app.initialized ) {
				return;
			}

			var template,
			    $container = $( '#5ftf-companies' );

			template = wp.template( '5ftf-companies' );
			$container.html( template( templateParams ) );
		}

		// re-render after sorting
	};

	app.init();
} );
