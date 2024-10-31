<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Add scripts and styles to the admin boxes
 * 
 */
function occasion_enqueue_scripts( $hook ) 
{
	global $post;
	$screens 	= array();
	$post_types = get_post_types( array('public' => true) );
	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_event_values_on_' . $post_type ) === 'show' )
		{
			array_push( $screens , $post_type );
		}

		if( get_option('_occasion_show_event_information_on_' . $post_type ) === 'show' )
		{
			array_push( $screens , $post_type );
		}

		if( get_option('_occasion_show_recurring_on_' . $post_type ) === 'show' )
		{
			array_push( $screens , $post_type );
		}
		
		if( get_option('_occasion_show_eventbrite_on_' . $post_type ) === 'show' )
		{
			array_push( $screens , $post_type );
		}
	}

	if ( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'settings_page_occasion-settings' ) 
	{
		if ( $hook == 'settings_page_occasion-settings' || in_array( $post->post_type, $screens ) ) 
		{
			// Custom styles
			wp_enqueue_style( 'occasion_admin_styles', plugins_url( 'assets/css/styles.css' , __FILE__ ) );

			// Custom scripts
			wp_enqueue_script( 'occasion_admin_scripts', plugins_url( 'assets/js/scripts.min.js' , __FILE__ ), array( 'jquery' ), '1.0', true );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'occasion_enqueue_scripts' );
?>