<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		2.2.0
 * 
 * Custom post status for archived events
 * 
 */
function occasion_archived_post_status() {
	register_post_status( 'occasion_archived', array(
		'label'                     => _x( 'Archived', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Archived <span class="count">(%s)</span>', 'Archived <span class="count">(%s)</span>' ),
	));

	$screens 	= array();
	$post_types = get_post_types( array('public' => true) );
	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_event_values_on_' . $post_type ) === 'show' )
		{
			array_push( $screens , $post_type );
		}
	}

	// Apply status to older events
	$args = array(
		'post_type'		=> 		$screens,
		'post_status'	=> 		array('publish', 'occasion_recurring' ),
		'meta_query'	=> 		array(
									array(
										'key' 		=> '_occasion_start_date',
										'value' 	=> date('Y-m-d'),
										'compare' 	=> '<'
									)
								)
	);
	$archived_events = get_posts( $args );

	foreach( $archived_events as $event )
	{
		$args = array(
			'ID'			=> $event->ID,
			'post_status' 	=> 'occasion_archived'
		);
		wp_update_post( $args );
	}
}
add_action( 'init', 'occasion_archived_post_status' );


/**
 * 
 * @since  		2.2.0
 * 
 * Add the post status as a choosible option
 * 
 */
function occasion_archived_post_status_list() {

	global $post;

	$label 		= '';
	$value 		= '';
	$complete 	= '';
	$span 		= '';
	$post_types = get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_event_values_on_' . $post_type ) == 'show' )
		{
			if( $post->post_type == $post_type )
			{
				if( $post->post_status == 'occasion_archived' )
				{
					$complete = ' selected=\"selected\"';
					$label = '<span id=\"post-status-display\"> Archived</span>';
				}
				echo '
				<script>
					jQuery(document).ready(function($){
						$("select#post_status").append("<option value=\"occasion_archived\" '.$complete.'>Archived</option>");
						$(".misc-pub-section label").append("'.$label.'");
					});
				</script>
				';
			}
		}	
	}
}
add_action('admin_footer-post.php', 'occasion_archived_post_status_list');

/**
 * 
 * @since  		2.2.0
 * 
 * Append the post status state to post list
 * 
 */
function occasion_archived_post_status_state( $states ) {

	global $post;
	
	$arg = get_query_var( 'post_status' );
	
	if( $arg != 'occasion_archived' )
	{
		if($post->post_status == 'occasion_archived')
		{
			return array('Archived');
		}
	}
    return $states;
}
add_filter( 'display_post_states', 'occasion_archived_post_status_state' );
?>