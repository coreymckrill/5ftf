<?php

/**
 * This file handles operations related to registering blocks and their assets. If there end up being more than one
 * or two, we may want to create a subfolder and have a separate file for each block.
 */

namespace WordPressDotOrg\FiveForTheFuture\Blocks;
use WordPressDotOrg\FiveForTheFuture\Company;

defined( 'WPINC' ) || die();

/**
 * todo
 *
 * @return string
 */
function render_shortcode() {
	$params = array(
		'post_type'      => Company\CPT_SLUG,
		'post_status'    => 'publish',
		'posts_per_page' => 2,
		'orderby'        => 'rand',
		// todo also in the "featured" taxonomy
	);

	$contributors = get_posts( $params );

	ob_start();
	require_once( dirname( __DIR__ ) . '/views/front-end.php' );
	return ob_get_clean();
}

add_shortcode( 'five_for_the_future', __NAMESPACE__ . '\render_shortcode' );

// shortcode for pledge form
// form handler for pledge form

function register() {
	//register_block_type();
}

add_action( 'init', __NAMESPACE__ . '\register' );
