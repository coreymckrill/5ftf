<?php

/**
 * This file handles the operations related to registering and handling company meta values for the CPT.
 */

namespace WordPressDotOrg\FiveForTheFuture\CompanyMeta;
use WordPressDotOrg\FiveForTheFuture\Company;
use WP_Post;

defined( 'WPINC' ) || die();

/**
 *
 */
function register() {
	//register_meta();
	// todo?
	// some contribors might not want hours_per_month being public
}

add_action( 'init', __NAMESPACE__ . '\register' );


/**
 * Adds meta boxes for the custom post type
 */
function add_meta_boxes() {
	add_meta_box(
		'company-information',
		__( 'Company Information', 'wordpressorg' ),
		__NAMESPACE__ . '\markup_meta_boxes',
		Company\CPT_SLUG,
		'normal',
		'default'
	);
}

add_action( 'admin_init', __NAMESPACE__ . '\add_meta_boxes' );

/**
 * Builds the markup for all meta boxes
 *
 * @param WP_Post $company
 * @param array   $box
 */
function markup_meta_boxes( $company, $box ) {
	/** @var $view string */

	switch ( $box['id'] ) {
		case 'company-information':
			$wporg_user = get_user_by( 'login', $company->_5ftf_wporg_username );
			$avatar_url = $wporg_user ? get_avatar_url( $wporg_user->ID ) : false;
			break;
	}

	require_once( dirname( __DIR__ ) . '/views/metabox-' . sanitize_file_name( $box['id'] ) . '.php' );
}

/**
 * Save the company data
 *
 * @param int     $company_id
 * @param WP_Post $company
 */
function save_company( $company_id, $company ) {
	$ignored_actions = array( 'trash', 'untrash', 'restore' );

	if ( isset( $_GET['action'] ) && in_array( $_GET['action'], $ignored_actions ) ) {
		return;
	}

	if ( ! $company || $company->post_type != Company\CPT_SLUG || ! current_user_can( 'edit_company', $company_id ) ) {
		return;
	}

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $company->post_status == 'auto-draft' ) {
		return;
	}

	save_company_meta( $company_id, $_POST );
}


add_action( 'save_post', __NAMESPACE__ . '\save_company', 10, 2 );

/**
 * Save the company's meta fields
 *
 * @param int   $company_id
 * @param array $new_values
 */
function save_company_meta( $company_id, $new_values ) {
	if ( isset( $new_values[ '_5ftf_wporg_username' ] ) ) {
		// todo validate username
		update_post_meta( $company_id, '_5ftf_wporg_username', $new_values[ '_5ftf_wporg_username' ] );
	} else {
		delete_post_meta( $company_id, '_5ftf_wporg_username' );
	}

	if ( isset( $new_values[ '_5ftf_hours_per_month' ] ) ) {
		update_post_meta( $company_id, '_5ftf_hours_per_month', absint( $new_values[ '_5ftf_hours_per_month' ] ) );
	} else {
		delete_post_meta( $company_id, '_5ftf_hours_per_month' );
	}

	// maybe set the wporg username as the company author, so they can edit it themselves to keep it updated,
	// then make the user a contributor if they don't already have a role on the site
	// setup cron to automatically email once per quarter
		// "here's all the info we have: x, y, z"
		// is that still accurate? if not, click here to update it
		// if want to be removed from public listing, emailing support@wordcamp.org
	// don't let them edit the "featured" taxonomy, only admins
}
