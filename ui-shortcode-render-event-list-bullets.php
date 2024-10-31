<?php
/**
 * @package Occasion
 */


/**
 * 
 * @since  		2.1.0
 * @updated 	2.3.2
 * 
 * Render a shortcode
 * 
 */
function occasion_events_list_render_shortcode_bullet( $args ) {

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

	$events = get_posts( occasion_query_arguements( $args ) );

	ob_start();

	if( count( $events ) > 0 )
	{	

		if( !empty( $args['message'] ) )
		{
			echo '<p>' . $args['message'] . '</p>';
		}
		?>
		<ul>
		<?php

		foreach( $events as $event )
		{
			$start_date = get_post_meta( $event->ID, '_occasion_start_date', true );
			$start_date = new DateTime($start_date);
			$start_time = strtotime( get_post_meta( $event->ID, '_occasion_start_time', true ) );
			$end_time = strtotime( get_post_meta( $event->ID, '_occasion_end_time', true ) );

			?>
			<li>
				<a href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a> <?php echo date( 'h:ia',  $start_time ) . ' - ' . date( 'h:ia',  $end_time ); ?> on <strong><?php echo $start_date->format('l, j F Y');?></strong>
			</li>
			<?php
		}

		?>
		</ul>
		<?php
	}
	return ob_get_clean();
}
add_shortcode( 'occasion_shortcode_bullet_list', 'occasion_events_list_render_shortcode_bullet' );
?>