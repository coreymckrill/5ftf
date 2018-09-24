<?php

/**
 * This file handles the operations related to setting up a custom post type. We change change the filename, namespace,
 * etc. once we have a better idea of what the CPT will be called.
 */

namespace WordPressDotOrg\FiveForTheFuture\Post;
defined( 'WPINC' ) || die();

const CPT_SLUG = '5ftf_post';

/**
 *
 */
function register() {
	register_custom_post_type();
	register_custom_taxonomy();
}

add_action( 'init', __NAMESPACE__ . '\register', 0 );

/**
 *
 */
function register_custom_post_type() {
	// TODO update the labels
	$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'wporg' ),
		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'wporg' ),
		'menu_name'             => __( 'Post Types', 'wporg' ),
		'name_admin_bar'        => __( 'Post Type', 'wporg' ),
		'archives'              => __( 'Item Archives', 'wporg' ),
		'attributes'            => __( 'Item Attributes', 'wporg' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wporg' ),
		'all_items'             => __( 'All Items', 'wporg' ),
		'add_new_item'          => __( 'Add New Item', 'wporg' ),
		'add_new'               => __( 'Add New', 'wporg' ),
		'new_item'              => __( 'New Item', 'wporg' ),
		'edit_item'             => __( 'Edit Item', 'wporg' ),
		'update_item'           => __( 'Update Item', 'wporg' ),
		'view_item'             => __( 'View Item', 'wporg' ),
		'view_items'            => __( 'View Items', 'wporg' ),
		'search_items'          => __( 'Search Item', 'wporg' ),
		'not_found'             => __( 'Not found', 'wporg' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wporg' ),
		'featured_image'        => __( 'Featured Image', 'wporg' ),
		'set_featured_image'    => __( 'Set featured image', 'wporg' ),
		'remove_featured_image' => __( 'Remove featured image', 'wporg' ),
		'use_featured_image'    => __( 'Use as featured image', 'wporg' ),
		'insert_into_item'      => __( 'Insert into item', 'wporg' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wporg' ),
		'items_list'            => __( 'Items list', 'wporg' ),
		'items_list_navigation' => __( 'Items list navigation', 'wporg' ),
		'filter_items_list'     => __( 'Filter items list', 'wporg' ),
	);

	$args = array(
		'label'               => __( 'Post Type', 'wporg' ),
		'description'         => __( 'Post Type Description', 'wporg' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'author' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 25,
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
	);

	register_post_type( '5ftf_post', $args );
}

/**
 *
 */
function register_custom_taxonomy() {
	// TODO update the labels
	$labels = array(
		'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'wporg' ),
		'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'wporg' ),
		'menu_name'                  => __( 'Taxonomy', 'wporg' ),
		'all_items'                  => __( 'All Items', 'wporg' ),
		'parent_item'                => __( 'Parent Item', 'wporg' ),
		'parent_item_colon'          => __( 'Parent Item:', 'wporg' ),
		'new_item_name'              => __( 'New Item Name', 'wporg' ),
		'add_new_item'               => __( 'Add New Item', 'wporg' ),
		'edit_item'                  => __( 'Edit Item', 'wporg' ),
		'update_item'                => __( 'Update Item', 'wporg' ),
		'view_item'                  => __( 'View Item', 'wporg' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'wporg' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'wporg' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg' ),
		'popular_items'              => __( 'Popular Items', 'wporg' ),
		'search_items'               => __( 'Search Items', 'wporg' ),
		'not_found'                  => __( 'Not Found', 'wporg' ),
		'no_terms'                   => __( 'No items', 'wporg' ),
		'items_list'                 => __( 'Items list', 'wporg' ),
		'items_list_navigation'      => __( 'Items list navigation', 'wporg' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
	);

	register_taxonomy( '5ftf_tax', array( '5ftf_post' ), $args );
}
