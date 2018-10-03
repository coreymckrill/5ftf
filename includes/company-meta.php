<?php

/**
 * This file handles the operations related to registering and handling company meta values for the CPT.
 */

namespace WordPressDotOrg\FiveForTheFuture\CompanyMeta;
use WordPressDotOrg\FiveForTheFuture\Company;
use WP_Post;

defined( 'WPINC' ) || die();

const META_PREFIX = '5ftf-';

/**
 *
 */
function register() {
	register_company_meta();
}

add_action( 'init', __NAMESPACE__ . '\register' );

/**
 * Register post meta keys for the Company post type.
 */
function register_company_meta() {
	$meta = [
		'company-name' => [
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
		],
		'company-url' => [
			'show_in_rest'      => true,
			'sanitize_callback' => 'esc_url_raw',
		],
		'company-email' => [
			'show_in_rest'      => false,
			'sanitize_callback' => 'sanitize_email',
		],
		'company-phone' => [
			'show_in_rest'      => false,
			'sanitize_callback' => 'sanitize_text_field',
		],
		'company-total-employees' => [
			'show_in_rest'      => true,
			'sanitize_callback' => 'absint',
		],
		'contact-name' => [
			'show_in_rest'      => false,
			'sanitize_callback' => 'sanitize_text_field',
		],
		'contact-wporg-username' => [
			'show_in_rest'      => false,
			'sanitize_callback' => 'sanitize_user',
		],
		'pledge-hours' => [
			'show_in_rest'      => true,
			'sanitize_callback' => 'absint',
		],
		'pledge-agreement' => [
			'show_in_rest'      => false,
			'sanitize_callback' => 'wp_validate_boolean',
		],
	];

	foreach ( $meta as $key => $args ) {
		$meta_key = META_PREFIX . $key;

		register_post_meta( Company\CPT_SLUG, $meta_key, $args );
	}
}

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
