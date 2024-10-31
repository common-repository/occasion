<?php
/**
 * @package Occasion
 */


/**
 * 
 * @since  		2.1.0
 * 
 * Render a shortcode for the event list
 * 
 */
function occasion_events_list_render_shortcode_bootstrap( $args ) {

	if( empty( $args ) )
	{
		$args = array();
	}

	$version = 3;

	if( !empty( $args['version'] ) && is_numeric( $args['version'] ) )
	{
		$version = $args['version'];
	}

	if( !empty( $args['taxonomy_terms'] ) )
	{
		$args['taxonomy_filter'] = true; // If the terms are set, we probebly want to filter by them
	}

	if( empty( $args['show_pagination'] ) )
	{
		$args['show_pagination'] = false; // We dont want to page by default
	}

	ob_start();

	occasion_events_list_render_bootstrap( $args, $version );

	return ob_get_clean();
}
add_shortcode( 'occasion_shortcode_bootstrap_list', 'occasion_events_list_render_shortcode_bootstrap' );
?>