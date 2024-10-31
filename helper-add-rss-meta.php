<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		2.2.0
 *
 * Add the meta information to the RSS feed
 * 
 */
function occasion_add_rss_meta() 
{
	global $post;
	global $thumbnail_added;

	if( has_post_thumbnail( $post->ID ) && !$thumbnail_added )
	{
		$thumbnail = get_attachment_link( get_post_thumbnail_id( $post->ID ) );
		echo( '<image>' . $thumbnail . '</image>' );
		$thumbnail_added = true;
	}

	$occasion_email 					= get_post_meta( $post->ID, '_occasion_email', true );
	$occasion_url 						= get_post_meta( $post->ID, '_occasion_url', true );
	$occasion_telephone 				= get_post_meta( $post->ID, '_occasion_telephone', true );
	$occasion_twitter 					= get_post_meta( $post->ID, '_occasion_twitter', true );
	$occasion_facebook 					= get_post_meta( $post->ID, '_occasion_facebook', true );
	$occasion_google 					= get_post_meta( $post->ID, '_occasion_google', true );
	$occasion_sms 						= get_post_meta( $post->ID, '_occasion_sms', true );
	$occasion_sms_instructions 			= get_post_meta( $post->ID, '_occasion_sms_instructions', true );
	$occasion_hashtag 					= get_post_meta( $post->ID, '_occasion_hashtag', true );
	$occasion_facebook_event 			= get_post_meta( $post->ID, '_occasion_facebook_event', true );
	$occasion_google_event 				= get_post_meta( $post->ID, '_occasion_google_event', true );
	$occasion_lanyrd 					= get_post_meta( $post->ID, '_occasion_lanyrd', true );
	$occasion_meetup 					= get_post_meta( $post->ID, '_occasion_meetup', true );
	$occasion_start_date 				= get_post_meta( $post->ID, '_occasion_start_date', true );
	$occasion_end_date 					= get_post_meta( $post->ID, '_occasion_end_date', true );
	$occasion_is_all_day 				= get_post_meta( $post->ID, '_occasion_is_all_day', true );
	$occasion_start_time 				= get_post_meta( $post->ID, '_occasion_start_time', true );
	$occasion_end_time 					= get_post_meta( $post->ID, '_occasion_end_time', true );
	$occasion_is_cancelled 				= get_post_meta( $post->ID, '_occasion_is_cancelled', true );
	$occasion_eventbrite 				= get_post_meta( $post->ID, '_occasion_eventbrite', true );

	if( !empty( $occasion_start_date ) )
	{
		echo('<event-start-date>' . $occasion_start_date . '</event-start-date>');
	}

	if( !empty( $occasion_end_date ) )
	{
		echo('<event-end-date>' . $occasion_end_date . '</event-end-date>');
	}
	if( !empty( $occasion_start_time ) )
	{
		echo('<event-start-time>' . $occasion_start_time . '</event-start-time>');
	}
	if( !empty( $occasion_end_time ) )
	{
		echo('<event-end-time>' . $occasion_end_time . '</event-end-time>');
	}
	if( !empty( $occasion_is_all_day ) )
	{
		echo('<event-is-all-day>' . $occasion_is_all_day . '</event-is-all-day>');
	}
	if( !empty( $occasion_is_cancelled ) )
	{
		echo('<event-is-cancelled>' . $occasion_is_cancelled . '</event-is-cancelled>');
	}
	if( !empty( $occasion_email ) )
	{
		echo('<event-email>' . $occasion_email . '</event-email>');
	}
	if( !empty( $occasion_telephone ) )
	{
		echo('<event-telephone>' . $occasion_telephone . '</event-telephone>');
	}
	if( !empty( $occasion_sms ) )
	{
		echo('<event-sms>' . $occasion_sms . '</event-sms>');
	}
	if( !empty( $occasion_sms_instructions ) )
	{
		echo('<event-sms-instructions>' . $occasion_sms_instructions . '</event-sms-instructions>');
	}
	if( !empty( $occasion_url ) )
	{
		echo('<event-website>' . esc_url( $occasion_url ) . '</event-website>');
	}
	if( !empty( $occasion_twitter ) )
	{
		echo('<event-twitter>' . esc_url( $occasion_twitter ) . '</event-twitter>');
	}
	if( !empty( $occasion_hashtag ) )
	{
		echo('<event-hashtag>' . esc_url( $occasion_hashtag ) . '</event-hashtag>');
	}
	if( !empty( $occasion_facebook ) )
	{
		echo('<event-facebook>' . esc_url( $occasion_facebook ) . '</event-facebook>');
	}
	if( !empty( $occasion_facebook_event ) )
	{
		echo('<event-facebook-event>' . esc_url( $occasion_facebook_event ) . '</event-facebook-event>');
	}
	if( !empty( $occasion_google ) )
	{
		echo('<event-google>' . esc_url( $occasion_google ) . '</event-google>');
	}
	if( !empty( $occasion_google_event ) )
	{
		echo('<event-google_event>' . esc_url( $occasion_google_event ) . '</event-google_event>');
	}
	if( !empty( $occasion_lanyrd ) )
	{
		echo('<event-lanyrd>' . esc_url( $occasion_lanyrd ) . '</event-lanyrd>');
	}
	if( !empty( $occasion_meetup ) )
	{
		echo('<event-meetup>' . esc_url( $occasion_meetup ) . '</event-meetup>');
	}
	if( !empty( $occasion_eventbrite ) )
	{
		echo('<event-eventbrite>' . esc_url( $occasion_eventbrite ) . '</event-eventbrite>');
	}
}
add_action('rss2_item', 'occasion_add_rss_meta');
?>