window.wp = window.wp || {};

jQuery( function( $ ) {
	'use strict';

	var allCompanies = window.fiveFutureCompanies || {},
	    sortOrder    = 'ascending';

	var app = window.wp.FiveForTheFuture = {
		// jsdoc
		init: function() {
			app.renderTemplate( allCompanies );

			$( '#5ftf-search' ).keyup( app.searchCompanies );
				// works on keyup but not change. isn't change better?
			$( '.5ftf-sorting-indicator' ).click( app.orderCompanies );
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
			allCompanies = _.sortBy( allCompanies, $( event.target ).data( 'field' ) );

			if ( 'ascending' === sortOrder ) {
				sortOrder    = 'descending';
				allCompanies = allCompanies.reverse();
				// set button value to be up/down
			} else {
				sortOrder = 'ascending';
				// set button value to be up/down
			}

			// add/remove 5ftf-current-sorter class

			app.renderTemplate( allCompanies );
		}
	};

	app.init();
} );
