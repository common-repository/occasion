<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.3.0
 * 
 * Custom post status for recurring events
 * 
 */
function occasion_recurring_post_status() {
	register_post_status( 'occasion_recurring', array(
		'label'                     => _x( 'Recurring', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Recurring <span class="count">(%s)</span>', 'Recurring <span class="count">(%s)</span>' ),
	));
}
add_action( 'init', 'occasion_recurring_post_status' );


/**
 * 
 * @since  		1.3.0
 * 
 * Add the post status as a choosible option
 * 
 */
function occasion_recurring_post_status_list() {

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

				if( $post->post_status == 'occasion_recurring' )
				{
					$complete = ' selected=\"selected\"';
					$label = '<span id=\"post-status-display\"> Recurring</span>';
				}
				echo '
				<script>
					jQuery(document).ready(function($){
						$("select#post_status").append("<option value=\"occasion_recurring\" '.$complete.'>Recurring</option>");
						$(".misc-pub-section label").append("'.$label.'");
					});
				</script>
				';
			}
		}	
	}
}
add_action('admin_footer-post.php', 'occasion_recurring_post_status_list', 1);

/**
 * 
 * @since  		1.3.0
 * 
 * Append the post status state to post list
 * 
 */
function occasion_recurring_post_status_state( $states ) {

	global $post;
	
	$arg = get_query_var( 'post_status' );
	
	if( $arg != 'occasion_recurring' )
	{
		if($post->post_status == 'occasion_recurring')
		{
			return array('Recurring');
		}
	}
    return $states;
}
add_filter( 'display_post_states', 'occasion_recurring_post_status_state' );
?>