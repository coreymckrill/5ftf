<?php

namespace WordPressDotOrg\FiveForTheFuture\PledgeForm;
defined( 'WPINC' ) || die();

use WordPressDotOrg\FiveForTheFuture;


function render_shortcode( $attributes, $content ) {
	$html = '';

	ob_start();

	require_once FiveForTheFuture\PATH . 'views/pledge-form.php';

	$html = ob_get_clean();

	return $html;
}

add_shortcode( 'five_for_the_future_pledge_form', __NAMESPACE__ . '\render_shortcode' );


function process_form() {

}
