<?php

/**
 * This file handles the operations related to registering and handling post meta values for the CPT.
 */

namespace WordPressDotOrg\FiveForTheFuture\PostMeta;
use WordPressDotOrg\FiveForTheFuture\Post;
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
		'contributor-information',
		__( 'Contributor Information', 'wordpressorg' ),
		__NAMESPACE__ . '\markup_meta_boxes',
		Post\CPT_SLUG,
		'normal',
		'default'
	);
}

add_action( 'admin_init', __NAMESPACE__ . '\add_meta_boxes' );

/**
 * Builds the markup for all meta boxes
 *
 * @param WP_Post $post
 * @param array   $box
 */
function markup_meta_boxes( $post, $box ) {
	/** @var $view string */

	switch ( $box['id'] ) {
		case 'contributor-information':
			$wporg_user = get_user_by( 'login', $post->_5ftf_wporg_username );
			$avatar_url = $wporg_user ? get_avatar_url( $wporg_user->ID ) : false;
			break;
	}

	require_once( dirname( __DIR__ ) . '/views/metabox-' . sanitize_file_name( $box['id'] ) . '.php' );
}

/**
 * Save the post data
 *
 * @param int     $post_id
 * @param WP_Post $post
 */
function save_post( $post_id, $post ) {
	$ignored_actions = array( 'trash', 'untrash', 'restore' );

	if ( isset( $_GET['action'] ) && in_array( $_GET['action'], $ignored_actions ) ) {
		return;
	}

	if ( ! $post || $post->post_type != Post\CPT_SLUG || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_status == 'auto-draft' ) {
		return;
	}

	save_post_meta( $post_id, $_POST );
}


add_action( 'save_post', __NAMESPACE__ . '\save_post', 10, 2 );

/**
 * Save the post's meta fields
 *
 * @param int   $post_id
 * @param array $new_values
 */
function save_post_meta( $post_id, $new_values ) {
	if ( isset( $new_values[ '_5ftf_wporg_username' ] ) ) {
		// todo validate username
		update_post_meta( $post_id, '_5ftf_wporg_username', $new_values[ '_5ftf_wporg_username' ] );
	} else {
		delete_post_meta( $post_id, '_5ftf_wporg_username' );
	}

	if ( isset( $new_values[ '_5ftf_hours_per_month' ] ) ) {
		update_post_meta( $post_id, '_5ftf_hours_per_month', absint( $new_values[ '_5ftf_hours_per_month' ] ) );
	} else {
		delete_post_meta( $post_id, '_5ftf_hours_per_month' );
	}

	// maybe set the wporg username as the post author, so they can edit it themselves to keep it updated,
	// then make the user a contributor if they don't already have a role on the site
	// setup cron to automatically email once per quarter
		// "here's all the info we have: x, y, z"
		// is that still accurate? if not, click here to update it
		// if want to be removed from public listing, emailing support@wordcamp.org
	// don't let them edit the "featured" taxonomy, only admins
}
