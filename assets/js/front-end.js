window.wp = window.wp || {};

jQuery( function( $ ) {
	'use strict';

	var allCompanies = window.fiveFutureCompanies || {};

	var app = window.wp.FiveForTheFuture = {
		// jsdoc
		init: function() {
			app.renderTemplate( allCompanies );

			$( '#5ftf-search' ).keyup( app.searchCompanies );  // debounce?
				// works on keyup but not change. isn't change better?
			$( '.5ftf-toggle-order' ).click( app.orderCompanies );
		},

		renderTemplate: function( companies ) {
			var $container = $( '#5ftf-companies' ),
			    template   = wp.template( '5ftf-companies' );

			$container.html( template( companies ) );
		},

		searchCompanies: function( event ) {
			var matches = $.extend( true, [], allCompanies );

			matches = _.filter( matches, function( company ) {
				return -1 !== company.name.indexOf( $( event.target ).val() );
			} );

			app.renderTemplate( matches );
		},

		orderCompanies: function( event ) {
			// _.sortBy ?
		}
	};

	app.init();
} );
