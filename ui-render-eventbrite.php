<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.2.0
 * 
 * Render the eventbrite embed box
 * 
 * @param  int 		$post_id 		The id of the post that has the embed code
 * @param  int 		$height  		The height of the embed in px
 * 
 * @return string          			The eventbrite embed iframe
 * 
 */
function occasion_get_everbrite_embed( $post_id, $height = 'auto' )
{

	$return = '';
	$occasion_eventbrite_id 	= get_post_meta( $post_id, '_occasion_eventbrite_id', true );
	$occasion_eventbrite_height = get_post_meta( $post_id, '_occasion_eventbrite_height', true );

	if( $height == 'auto' && !empty( $occasion_eventbrite_height ) )
	{
		$height = $occasion_eventbrite_height;
	}

	if( !empty( $occasion_eventbrite_id ) )
	{
		$return = '<iframe src="http://www.eventbrite.co.uk/tickets-external?eid=' . $occasion_eventbrite_id . '&amp;ref=etckt&amp;v=2" frameborder="0" height="' . $height . '" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="none" allowtransparency="true"></iframe>';
	}

	return $return;
}