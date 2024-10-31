<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		2.0.0
 * 
 * Create a custom taxonomy to add categorise occasion items
 * 
 */
function occasion_create_category_taxonomy() {

	$taxonomy 	= 'occasion_category';
	$labels 	= array();
	$args 		= array();

	// Set labels for the custom taxonomy
	$labels = array(
		'name'              => _x( 'Event Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Event Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Event Categories' ),
		'all_items'         => __( 'All Event Categories' ),
		'parent_item'       => __( 'Parent Event Category' ),
		'parent_item_colon' => __( 'Parent Event Category:' ),
		'edit_item'         => __( 'Edit Event Category' ),
		'update_item'       => __( 'Update Event Category' ),
		'add_new_item'      => __( 'Add New Event Category' ),
		'new_item_name'     => __( 'New Event Category Name' ),
		'menu_name'         => __( 'Event Categories' )
	);

	// Set the arguements for the custom taxonomy
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => false
	);

	register_taxonomy( $taxonomy, array( 'occasion_events' ), $args );
}
add_action( 'init', 'occasion_create_category_taxonomy', 0 );
?>