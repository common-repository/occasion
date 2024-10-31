<?php
/**
 * @package Occasion
 */

/**
 *
 * @since 		1.0.0
 *
 * Creates a custom post type for the events
 *
 */
function occasion_create_post_type() {

	$labels 	= array();
	$args 		= array();

	// Set labels for the custom post type
	$labels = array(
		'name'               => _x( 'Events', 'post type general name' ),
		'singular_name'      => _x( 'Event', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'event' ),
		'add_new_item'       => __( 'Add New Event' ),
		'edit_item'          => __( 'Edit Event' ),
		'new_item'           => __( 'New Event' ),
		'all_items'          => __( 'All Events' ),
		'view_item'          => __( 'View Event' ),
		'search_items'       => __( 'Search Events' ),
		'not_found'          => __( 'No events found' ),
		'not_found_in_trash' => __( 'No events found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Events'
	);

	// Set the arguements for the custom post type
	$args = array(
		'rewrite' 				=> array( 'slug' => 'events' ),
		'labels'				=> $labels,
		'description'			=> 'Events',
		'public'				=> true,
		'menu_position'			=> 20,
		'menu_icon'				=> 'dashicons-calendar',
		'hierarchical'			=> true,
		'has_archive'			=> true,
		'supports'				=> array(
									'title',
									'editor',
									'author',
									'thumbnail',
									'excerpt',
									'custom-fields',
									'revisions',
									'comments',
									'page-attributes'
									)
	);

	// Register the custom post type
	if( get_option('_occasion_show_events_cpt') == 'show' )
	{
		register_post_type( 'occasion_events', $args );
	}
}
add_action( 'init', 'occasion_create_post_type' );


/**
 *
 * @since 		2.3.0
 * @updated 	2.3.1
 *
 * Hide meta boxes by default
 *
 */
function occasion_change_default_hidden( $hidden, $screen ) {
	if ( 'occasion_events' == $screen->id ) {
		$hidden[] 	= 'postcustom';
		$hidden[] 	= 'trackbacksdiv';
		$hidden[] 	= 'commentstatusdiv';
		$hidden[] 	= 'commentsdiv';
		$hidden[] 	= 'slugdiv';
		$hidden[] 	= 'authordiv';
		$hidden[] 	= 'revisionsdiv';
		$hidden[]	= 'pageparentdiv';
	}
	return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'occasion_change_default_hidden', 10, 2 );


/**
 *
 * @since 		1.1.1
 *
 * Register post thumbnails
 *
 */
function occasion_register_post_thumbnails()
{
	$post_thumbnails = get_theme_support( 'post-thumbnails' );
	$new_post_thumbnails = array();

	if( is_array( $post_thumbnails ) )
	{
		if( is_array( $post_thumbnails[0] ) )
		{
			foreach( $post_thumbnails[0] as $value )
			{
				array_push( $new_post_thumbnails, $value );
			}
		}
	}

	array_push( $new_post_thumbnails, 'occasion_events' );

	// Add support for post thumbnails to the theme
	add_theme_support( 'post-thumbnails', $new_post_thumbnails );

	// Add custom image sizes
	if( !in_array( 'square-75', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-75', 75, 75, true );
	}

	if( !in_array( 'square-150', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-150', 150, 150, true );
	}

	if( !in_array( 'square-300', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-300', 300, 300, true );
	}

	if( !in_array( 'square-600', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-600', 600, 600, true );
	}

	if( !in_array( 'square-1200', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-1200', 1200, 1200, true );
	}
}
add_action( 'after_setup_theme', 'occasion_register_post_thumbnails' );
?>