<?php

/**
 * This file handles the operations related to registering and handling post meta values for the CPT.
 */

namespace WordPressDotOrg\FiveForTheFuture\PostMeta;
defined( 'WPINC' ) || die();

/**
 *
 */
function register() {
	//register_meta();
}

add_action( 'init', __NAMESPACE__ . '\register' );
