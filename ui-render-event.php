<?php
/**
 * @package Occasion
 */


/**
 * 
 * @since  		2.0.0
 * 
 * Render bootstrap 
 * 
 */
function occasion_render_bootstrap( $post_id, $args = array(), $version = '3' )
{
	// Future proofing, set the version of Bootstrap we wish to render
	// if( $version == '3' ){ // Render here }

	occasion_render_bootstrap_3( $post_id, $args );
}


/**
 * 
 * @since  		2.0.0
 * 
 * Render bootstrap 3
 *
 * @param 		int 		$post_id 	the post id to render
 * @param 		array 		$args 		arguments to define render
 * 
 */
function occasion_render_bootstrap_3( $post_id, $args = array() ) 
{
	$defaults = array(
		'class_address_wrapper'			=> '',						// The class of the address wrapper
		'class_content_wrapper' 		=> '',						// The class of the content wrapper
		'class_header'					=> '',						// The class of the header tag
		'class_image_wrapper' 			=> 'pull-right',			// The class of the image wrapper
		'class_link_wrapper' 			=> 'pull-right',			// The class of the map link wrapper
		'class_meta_label_wrapper'		=> 'col-md-2',				// The class of the label wrapper
		'class_wrapper'					=> 'location__wrapper',		// The class of the location wrapper
		'class_meta_row'				=> 'row',					// The class of the row
		'class_meta_value_wrapper'		=> 'col-md-10',				// The class of the value wrapper
		'class_map_wrapper'				=> 'location__map',			// The class of the map wrapper
		'class_title'					=> 'location__title',		// The class of the title
		'date_format'					=> 'F jS, Y',				// The format of the date output
		'id'							=> 'position',				// If you want to have multiple renders, you will want to change the id each time
		'post_type'						=> 'position',				// [ post | page | custom post type | array() ]			
		'show_content'					=> true,					// [ true | false ] - show the post content in the list
		'show_email'					=> true,					// [ true | false ] - show the email in the list
		'show_end_date'					=> true,					// [ true | false ] - show the end date
		'show_end_time'					=> true,					// [ true | false ] - show the end time
		'show_eventbrite'				=> true,					// [ true | false ] - show the embeded eventbrite
		'show_facebook'					=> true,					// [ true | false ] - show facebook in the list
		'show_facebook_event'			=> true,					// [ true | false ] - show the facebook event field
		'show_google'					=> true,					// [ true | false ] - show google+ in the list
		'show_google_event'				=> true,					// [ true | false ] - show the google event field
		'show_hashtag'					=> true,					// [ true | false ] - show the hashtag
		'show_image'					=> true, 					// [ true | false ] - show images in the list
		'show_is_all_day'				=> true,					// [ true | false ] - show if the event is all day
		'show_is_cancelled'				=> true,					// [ true | false ] - show if the event is cancelled
		'show_lanyrd'					=> true,					// [ true | false ] - show the lanyard link
		'show_location'					=> true,					// If a related location is set, show it (this requires the plugin 'Position' to be installed)
		'show_meetup'					=> true,					// [ true | false ] - show the meetup link
		'show_sms'						=> true,					// [ true | false ] - show the sms
		'show_sms_instructions'			=> true,					// [ true | false ] - show the sms instructions
		'show_start_date'				=> true,					// [ true | false ] - show the start date
		'show_start_time'				=> true,					// [ true | false ] - show the start time
		'show_telephone'				=> true,					// [ true | false ] - show the telephone number
		'show_twitter'					=> true,					// [ true | false ] - show twitter in the list
		'show_website'					=> true,					// [ true | false ] - show the website url in the list
		'tag_meta_label_wrapper_close' 	=> '</strong></p>',			// The tag(s) you wish to close the label with
		'tag_meta_label_wrapper_open' 	=> '<p><strong>',			// The tag(s) you wish to open the label with
		'tag_meta_value_wrapper_close' 	=> '</p>',					// The tag(s) you wish to close the value with
		'tag_meta_value_wrapper_open' 	=> '<p>',					// The tag(s) you wish to open the value with
		'time_format'					=> 'g:i A',
	);

	$r 									= array_merge( $defaults, $args );
	$event 								= get_post( $post_id );
	$post_thumbnail_id 					= get_post_thumbnail_id( $post_id );

	$occasion_email 					= get_post_meta( $post_id, '_occasion_email', true );
	$occasion_url 						= get_post_meta( $post_id, '_occasion_url', true );
	$occasion_telephone 				= get_post_meta( $post_id, '_occasion_telephone', true );
	$occasion_twitter 					= get_post_meta( $post_id, '_occasion_twitter', true );
	$occasion_facebook 					= get_post_meta( $post_id, '_occasion_facebook', true );
	$occasion_google 					= get_post_meta( $post_id, '_occasion_google', true );
	$occasion_sms 						= get_post_meta( $post_id, '_occasion_sms', true );
	$occasion_sms_instructions 			= get_post_meta( $post_id, '_occasion_sms_instructions', true );
	$occasion_hashtag 					= get_post_meta( $post_id, '_occasion_hashtag', true );
	$occasion_facebook_event 			= get_post_meta( $post_id, '_occasion_facebook_event', true );
	$occasion_google_event 				= get_post_meta( $post_id, '_occasion_google_event', true );
	$occasion_lanyrd 					= get_post_meta( $post_id, '_occasion_lanyrd', true );
	$occasion_meetup 					= get_post_meta( $post_id, '_occasion_meetup', true );
	$occasion_start_date 				= get_post_meta( $post_id, '_occasion_start_date', true );
	$occasion_end_date 					= get_post_meta( $post_id, '_occasion_end_date', true );
	$occasion_is_all_day 				= get_post_meta( $post_id, '_occasion_is_all_day', true );
	$occasion_start_time 				= get_post_meta( $post_id, '_occasion_start_time', true );
	$occasion_end_time 					= get_post_meta( $post_id, '_occasion_end_time', true );
	$occasion_is_cancelled 				= get_post_meta( $post_id, '_occasion_is_cancelled', true );

	$occasion_show_name 				= get_option( '_occasion_show_name' );
	$occasion_show_email 				= get_option( '_occasion_show_email' );
	$occasion_show_website 				= get_option( '_occasion_show_url' );
	$occasion_show_telephone 			= get_option( '_occasion_show_telephone' );
	$occasion_show_twitter 				= get_option( '_occasion_show_twitter' );
	$occasion_show_facebook 			= get_option( '_occasion_show_facebook' );
	$occasion_show_google 				= get_option( '_occasion_show_google' );
	$occasion_show_sms 					= get_option( '_occasion_show_sms' );
	$occasion_show_sms_instructions 	= get_option( '_occasion_show_sms_instructions' );
	$occasion_show_hashtag 				= get_option( '_occasion_show_hashtag' );
	$occasion_show_facebook_event 		= get_option( '_occasion_show_facebook_event' );
	$occasion_show_google_event 		= get_option( '_occasion_show_google_event' );
	$occasion_show_lanyrd 				= get_option( '_occasion_show_lanyrd' );
	$occasion_show_meetup 				= get_option( '_occasion_show_meetup' );

	if( $occasion_show_email 			!= 'true' 	|| !$r['show_email'] ) 				$occasion_email 			= null;
	if( $occasion_show_website 			!= 'true' 	|| !$r['show_website'] ) 			$occasion_url 				= null;
	if( $occasion_show_telephone 		!= 'true' 	|| !$r['show_telephone'] ) 			$occasion_telephone 		= null;
	if( $occasion_show_twitter 			!= 'true' 	|| !$r['show_twitter'] ) 			$occasion_twitter 			= null;
	if( $occasion_show_facebook			!= 'true' 	|| !$r['show_facebook'] ) 			$occasion_facebook 			= null;
	if( $occasion_show_google			!= 'true' 	|| !$r['show_google'] ) 			$occasion_google 			= null;

	if( $occasion_show_sms				!= 'true' 	|| !$r['show_sms'] ) 				$occasion_sms 				= null;
	if( $occasion_show_sms_instructions	!= 'true' 	|| !$r['show_sms_instructions'] ) 	$occasion_sms_instructions 	= null;
	if( $occasion_show_hashtag			!= 'true' 	|| !$r['show_hashtag'] ) 			$occasion_hashtag 			= null;
	if( $occasion_show_facebook_event	!= 'true' 	|| !$r['show_facebook_event'] ) 	$occasion_facebook_event 	= null;
	if( $occasion_show_google_event		!= 'true' 	|| !$r['show_google_event'] ) 		$_occasion_google_event 	= null;
	if( $occasion_show_lanyrd			!= 'true' 	|| !$r['show_lanyrd'] ) 			$occasion_lanyrd 			= null;
	if( $occasion_show_meetup			!= 'true' 	|| !$r['show_meetup'] ) 			$occasion_meetup 			= null;


	if( !$r['show_start_date'] ) 		$occasion_start_date 	= null;
	if( !$r['show_end_date'] )			$occasion_end_date 		= null;
	if( !$r['show_is_all_day'] )		$occasion_is_all_day 	= null;
	if( !$r['show_start_time'] ) 		$occasion_start_time 	= null;
	if( !$r['show_end_time'] ) 			$occasion_end_time 		= null;
	if( !$r['show_is_cancelled'] ) 		$occasion_is_cancelled 	= null;

	?>
	<section id="<?php echo $r['id']; ?>" class="<?php echo $r['class_wrapper']; ?> vcard organisation">
		
		<?php 

		?>
		<header class="<?php echo $r['class_header']; ?>">
			<h1 class="<?php echo $r['class_title']; ?> org"><?php echo $event->post_title; ?></h1>
		</header>
		<?php
		
		if( $r['show_image'] )
		{
			?>
			<div class="<?php echo $r['class_image_wrapper']; ?>"><?php echo wp_get_attachment_image( $post_thumbnail_id, 'medium' ); ?></div>
			<?php
		}
		?>
		<?php 
		if( $r['show_content'] )
		{
			?>
			<div class="<?php echo $r['class_content_wrapper']; ?>">
				<?php echo wpautop( $event->post_content );?>
			</div>
			<?php
		}
		if( !empty( $occasion_start_date ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Start date
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo date( $r['date_format'], strtotime( $occasion_start_date ) );?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_end_date ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Start date
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo date( $r['date_format'], strtotime( $occasion_end_date ) );?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_start_time ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Start time
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo date( $r['time_format'], strtotime( $occasion_start_time ) );?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_end_time ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						End time
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo date( $r['time_format'], strtotime( $occasion_end_time ) );?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_is_all_day ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						All day event
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo $occasion_is_all_day;?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_is_cancelled ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						All day event
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo $occasion_is_cancelled;?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_email ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
						<?php echo $r['tag_meta_label_wrapper_open']; ?>
							Email
						<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="email" href="mailto:<?php echo $occasion_email; ?>"><?php echo $occasion_email; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_telephone ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Telephone
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="tel" href="tel:<?php echo str_replace( ' ','', $occasion_telephone ); ?>"><?php echo $occasion_telephone; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_sms ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						SMS
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="tel" href="tel:<?php echo str_replace( ' ','', $occasion_sms ); ?>"><?php echo $occasion_sms; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_sms_instructions ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						SMS Instructions
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo $occasion_sms_instructions; ?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_url ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Website
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="url" href="<?php echo $occasion_url; ?>" target="_blank"><?php echo $occasion_url; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_twitter ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Twitter
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="http://twitter.com/<?php echo $occasion_twitter; ?>" target="_blank">@<?php echo $occasion_twitter; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_hashtag ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Twitter
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="http://twitter.com/#<?php echo $occasion_hashtag; ?>" target="_blank">#<?php echo $occasion_hashtag; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_facebook ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Facebook
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $occasion_facebook; ?>" target="_blank"><?php echo $occasion_facebook; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_facebook_event ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Facebook event
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $occasion_facebook_event; ?>" target="_blank"><?php echo $occasion_facebook_event; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_google ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Google+
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $occasion_google; ?>" target="_blank"><?php echo $occasion_google; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_google_event ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Google+ event
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $occasion_google_event; ?>" target="_blank"><?php echo $occasion_google_event; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_lanyrd ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Lanyrd
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $occasion_lanyrd; ?>" target="_blank"><?php echo $occasion_lanyrd; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $occasion_meetup ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Meetup
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $occasion_meetup; ?>" target="_blank"><?php echo $occasion_meetup; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( $r['show_eventbrite'] )
		{
			echo occasion_get_everbrite_embed( $post_id );
		}
		if( $r['show_location'] )
		{
			$position_related = get_post_meta( $post_id, '_position_related', true );

			if( !empty( $position_related ) )
			{
				position_render_bootstrap( $position_related );
			}
		}
		?>
	</section>

	<?php
}
?>