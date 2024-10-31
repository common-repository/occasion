<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.1.0
 * 
 * Return loop query args
 *
 * @param 		array 		$args 		argumens to define filter	
 * @return 		array 		arguments to filter wp_query
 * 
 */
function occasion_query_arguements( $args = array() ) 
{
	$defaults = array(
		'featured'					=> false, 										// [ true | false ] - Set to true to return posts that have the featured post custom meta data set to true
		'featured_post_meta_key' 	=> '_occasion_featured',						// The custom meta field that identifies the featured post, will also accept an array
		'include_in_progress'		=> true,										// [ true | false ] - Include events where the start date has passed, but the end date has not (in progress events)
		'meta_key' 					=> '_occasion_start_date',						// The meta key you wish to order the query by
		'order'						=> 'ASC',										// [ ASC | DESC ]
		'orderby'					=> 'meta_value', 							// [ date | menu_order | title | meta_value ] 
		'posts_per_page'			=> 10,											// Set number of posts to return, -1 will return all
		'post_status'				=> array('publish', 'occasion_recurring' ),		// Array or string, which kind of post status you wish to include in your results
		'post_type'					=> 'occasion_events',							// [ post | page | custom post type | array() ]			
		'show_only_future'			=> true,										// [ true | false ] - show only events happening, or going to happen, do not show archived events
		'show_only_future_compare'	=> '>=',										// The compare for future events
		'taxonomy_filter'			=> false,										// [ true | false ] - Set to true to filter by taxonomy
		'taxonomy_key'				=> 'occasion_category',							// The key of the taxonomy we wish to filter by
		'taxonomy_terms'			=> 'event',										// The terms (uses slug), will accept a string or array
		'use_featured_image'		=> false 										// [ true | false ] - Set to true to only use posts with a featured image
	);

	$return_args					= array();
	$r 								= array_merge( $defaults, $args );
	$meta_query_args				= null;
	$tax_query_args 				= null;

	if( $r['use_featured_image'] )
	{
		$meta_query_args 			= 	array(
											'relation' 		=> 'AND',
											array(
												'key' 		=> '_thumbnail_id'
											)
										);
	}

	if( $r['show_only_future'] )
	{
		$key = '_occasion_start_date';

		if( $r['include_in_progress'] )
		{
			$key = '_occasion_end_date';
		}

		if( is_array( $meta_query_args ) )
		{
			$meta_query_args_append 	= array(
													'key' 		=> $key,
													'value' 	=> date('Y-m-d'),
	                								'compare' 	=> $r['show_only_future_compare']
												);
			array_push( $meta_query_args, $meta_query_args_append );
		}
		else
		{
			$meta_query_args 			= 	array(
												'relation' 		=> 'AND',
												array(
													'key' 		=> $key,
													'value' 	=> date('Y-m-d'),
													'compare' 	=> $r['show_only_future_compare']
												)
											);
		}
	}

	if( $r['featured'] )
	{
		if( is_array( $r['featured_post_meta_key'] ) )
		{
			foreach( $r['featured_post_meta_key'] as $featured_post_meta_key )
			{
				$query = array(
					'key' 		=> $featured_post_meta_key,
		 			'value' 	=> 'true',
		 			'compare' 	=> '='
				);

				array_push( $meta_query_args, $query );
			}
		}
		elseif( is_string( $r['featured_post_meta_key'] ) )
		{
			$query = array(
				'key' 		=> $r['featured_post_meta_key'],
	 			'value' 	=> 'true',
	 			'compare' 	=> '='
			);

			array_push( $meta_query_args, $query );
		}
	}

	if( $r['taxonomy_filter'] )
	{
		$tax_query_args = array(
			'taxonomy' 	=> $r['taxonomy_key'],
			'field' 	=> 'slug',
			'terms' 	=> $r['taxonomy_terms']
		);
	}

	if ( get_query_var('paged') ) 
	{ 
		$paged = get_query_var('paged'); 
	}
	else if ( get_query_var('page') ) 
	{ 
		$paged = get_query_var('page'); 
	}
	else 
	{ 
		$paged = 1; 
	}

	if( !$r['show_pagination'] )
	{
		$paged = 1; 
	}

	$return_args = 	array(
						'meta_key'					=> $r['meta_key'],
						'paged'						=> $paged,
						'post_status'				=> $r['post_status'],
						'post_type'					=> $r['post_type'],
						'orderby'					=> $r['orderby'],
						'order'						=> $r['order'],
						'posts_per_page'			=> $r['posts_per_page'],
						'posts_per_archive_page'	=> $r['posts_per_page'],
						'showposts'					=> $r['posts_per_page'],
						'meta_query' 				=> $meta_query_args,
						'tax_query' 				=> array( $tax_query_args )
					);

	return $return_args;
}

?>