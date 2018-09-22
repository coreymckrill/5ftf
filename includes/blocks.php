<?php

/**
 * This file handles operations related to registering blocks and their assets. If there end up being more than one
 * or two, we may want to create a subfolder and have a separate file for each block.
 */

namespace WordPressDotOrg\FiveForTheFuture\Blocks;
defined( 'WPINC' ) || die();


function register() {
	//register_block_type();
}

add_action( 'init', __NAMESPACE__ . '\register' );
