<?php
/**
 * @package Occasion
 */


/**
 * 
 * @since  		1.3.0
 * 
 * Add columns to event list view
 * 
 */
function occasion_add_columns( $columns ) {
	
	return array_merge( 
		$columns, 
		array(
			'_occasion_start_date' 	=> __('Start Date'),
			'_occasion_end_date' 	=> __('End Date')
		) 
	);
}


/**
 * 
 * @since  		1.3.0
 * 
 * Custom post status for recurring events
 * 
 */
function occasion_column_values( $column, $post_id ) {
	
	switch ( $column ) 
	{
		case '_occasion_start_date' :
			echo get_post_meta( $post_id, '_occasion_start_date', true );
		break;
		case '_occasion_end_date' :
			echo get_post_meta( $post_id, '_occasion_end_date', true );
		break;
	}
}


function occasion_apply_column_filters() {

	$post_types = get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_event_values_on_' . $post_type ) == 'show' )
		{
			add_filter('manage_' . $post_type . '_posts_columns' , 'occasion_add_columns');
			add_action('manage_' . $post_type . '_posts_custom_column', 'occasion_column_values', 10, 2);
		}	
	}
}
add_action('init', 'occasion_apply_column_filters');

?>