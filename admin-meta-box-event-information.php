<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Custom meta box for event information
 * 
 */
function occasion_event_information_meta_box() {

	// Only add the box to the selected post types
	$screens 		= array();
	$post_types 	= get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_event_information_on_' . $post_type ) === 'show' )
		{
			array_push( $screens, $post_type );
		}
	}

	foreach ( $screens as $screen ) 
	{
		add_meta_box(
			'occasion_event_information',
			'Event information',
			'occasion_event_information_render_meta_box',
			$screen
		);
	}

}
add_action( 'add_meta_boxes', 'occasion_event_information_meta_box' );



/**
 * 
 * @since  		1.0.0
 * 
 * Render the cost meta box
 * 
 */
function occasion_event_information_render_meta_box( $post ) {

	$occasion_url 				= get_post_meta( $post->ID, '_occasion_url', true );
	$occasion_email 			= get_post_meta( $post->ID, '_occasion_email', true );
	$occasion_sms 				= get_post_meta( $post->ID, '_occasion_sms', true );
	$occasion_sms_instructions 	= get_post_meta( $post->ID, '_occasion_sms_instructions', true );
	$occasion_telephone 		= get_post_meta( $post->ID, '_occasion_telephone', true );
	$occasion_hashtag 			= get_post_meta( $post->ID, '_occasion_hashtag', true );
	$occasion_twitter 			= get_post_meta( $post->ID, '_occasion_twitter', true );
	$occasion_facebook 			= get_post_meta( $post->ID, '_occasion_facebook', true );
	$occasion_facebook_event 	= get_post_meta( $post->ID, '_occasion_facebook_event', true );
	$occasion_google 			= get_post_meta( $post->ID, '_occasion_google', true );
	$occasion_google_event 		= get_post_meta( $post->ID, '_occasion_google_event', true );
	$occasion_lanyrd 			= get_post_meta( $post->ID, '_occasion_lanyrd', true );
	$occasion_meetup 			= get_post_meta( $post->ID, '_occasion_meetup', true );

	?>
		<div class="occasion_event_information cf">

			<?php

				if( get_option('_occasion_show_url') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_url">Website URL</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_url" name="occasion_url" value="<?php echo $occasion_url; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_email') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_email">Email</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_email" name="occasion_email" value="<?php echo $occasion_email; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_sms') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_sms">SMS number</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_sms" name="occasion_sms" value="<?php echo $occasion_sms; ?>"/>
							</div>
						</div>
					</p>
				<?php
				}
				if( get_option('_occasion_show_sms_instructions') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_sms_instructions">SMS instructions</label>
								</strong>
							</div>
							<div class="input__container">
									<textarea id="occasion_sms_instructions" name="occasion_sms_instructions" ><?php echo $occasion_sms_instructions; ?></textarea>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_telephone') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_telephone">Telephone</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="tel" id="occasion_telephone" name="occasion_telephone" value="<?php echo $occasion_telephone; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_hashtag') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_hashtag">Hashtag</label>
								</strong>
							</div>
							<div class="input__container">
								<div class="input__wrapper">
									<span class="help-inline hash">#</span><input type="text" id="occasion_hashtag" name="occasion_hashtag" value="<?php echo $occasion_hashtag; ?>"/>
								</div>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_twitter') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_twitter">Twitter</label>
								</strong>
							</div>
							<div class="input__container">
								<div class="input__wrapper">
									<span class="help-inline at">@</span><input type="text" id="occasion_twitter" name="occasion_twitter" value="<?php echo $occasion_twitter; ?>"/>
								</div>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_facebook') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_facebook">Facebook</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_facebook" name="occasion_facebook" value="<?php echo $occasion_facebook; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_facebook_event') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_facebook_event">Facebook event</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_facebook_event" name="occasion_facebook_event" value="<?php echo $occasion_facebook_event; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_google') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_google">Google+</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_google" name="occasion_google" value="<?php echo $occasion_google; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_google_event') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_google_event">Google+ event</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_google_event" name="occasion_google_event" value="<?php echo $occasion_google_event; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_lanyrd') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_lanyrd">Lanyrd</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_lanyrd" name="occasion_lanyrd" value="<?php echo $occasion_lanyrd; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_occasion_show_meetup') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="occasion_meetup">Meetup</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="occasion_meetup" name="occasion_meetup" value="<?php echo $occasion_meetup; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
			?>
		</div>

	<?php

	wp_nonce_field( 'submit_occasion_event_information_values', 'occasion_event_information_nonce' ); 
}


/**
 * 
 * @since  		1.0.0
 * 
 * Handle the event information meta box post data
 * 
 */
function occasion_event_information_handle_post_data( $post_id )
{
	$nonce_key							= 'occasion_event_information_nonce';
	$nonce_action						= 'submit_occasion_event_information_values';

	// If it is just a revision don't worry about it
	if ( wp_is_post_revision( $post_id ) )
		return $post_id;

	// Check it's not an auto save routine
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	// Verify the nonce to defend against XSS
	if ( !isset( $_POST[$nonce_key] ) || !wp_verify_nonce( $_POST[$nonce_key], $nonce_action ) )
		return $post_id;

	// Check that the current user has permission to edit the post
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$occasion_url 				= isset( $_POST['occasion_url'] ) 				? esc_url_raw( $_POST['occasion_url'] ) 				: null;
	$occasion_email 			= isset( $_POST['occasion_email'] ) 			? sanitize_email( $_POST['occasion_email'] )			: null;
	$occasion_sms 				= isset( $_POST['occasion_sms'] ) 				? $_POST['occasion_sms'] 								: null;
	$occasion_sms_instructions 	= isset( $_POST['occasion_sms_instructions'] )	 ? esc_textarea( $_POST['occasion_sms_instructions'] )	: null;
	$occasion_telephone 		= isset( $_POST['occasion_telephone'] ) 		? $_POST['occasion_telephone'] 							: null;
	$occasion_hashtag 			= isset( $_POST['occasion_hashtag'] ) 			? $_POST['occasion_hashtag'] 							: null;
	$occasion_twitter 			= isset( $_POST['occasion_twitter'] ) 			? $_POST['occasion_twitter'] 							: null;
	$occasion_facebook 			= isset( $_POST['occasion_facebook'] ) 			? esc_url_raw( $_POST['occasion_facebook'] ) 			: null;
	$occasion_facebook_event 	= isset( $_POST['occasion_facebook_event'] ) 	? esc_url_raw( $_POST['occasion_facebook_event'] )		: null;
	$occasion_google 			= isset( $_POST['occasion_google'] ) 			? esc_url_raw( $_POST['occasion_google'] ) 				: null;
	$occasion_google_event 		= isset( $_POST['occasion_google_event'] )	 	? esc_url_raw( $_POST['occasion_google_event'] )		: null;
	$occasion_lanyrd 			= isset( $_POST['occasion_lanyrd'] ) 			? esc_url_raw( $_POST['occasion_lanyrd'] )				: null;
	$occasion_meetup 			= isset( $_POST['occasion_meetup'] ) 			? esc_url_raw( $_POST['occasion_meetup'] )				: null;

	if( !empty( $occasion_sms ) )
	{
		$occasion_sms = preg_replace( '/[^0-9\s]/', '', $occasion_sms );
		$occasion_sms = preg_replace( '/\s\s+/', ' ', $occasion_sms );
		$occasion_sms = trim( $occasion_sms );
	}

	if( !empty( $occasion_telephone ) )
	{
		$occasion_telephone = preg_replace( '/[^0-9\s]/', '', $occasion_telephone );
		$occasion_telephone = preg_replace( '/\s\s+/', ' ', $occasion_telephone );
		$occasion_telephone = trim( $occasion_telephone );
	}

	if( !empty( $occasion_hashtag ) )
	{
		$occasion_hashtag = preg_replace( '/[^0-9A-Z]/', '', $occasion_hashtag );
	}

	if( !empty( $occasion_twitter ) )
	{
		$occasion_twitter = preg_replace( '/[^0-9a-zA-Z_]/', '', $occasion_twitter );
	}

	update_post_meta( $post_id, '_occasion_url', 					$occasion_url );
	update_post_meta( $post_id, '_occasion_email', 					$occasion_email );
	update_post_meta( $post_id, '_occasion_sms', 					$occasion_sms );
	update_post_meta( $post_id, '_occasion_sms_instructions', 		$occasion_sms_instructions );
	update_post_meta( $post_id, '_occasion_telephone', 				$occasion_telephone );
	update_post_meta( $post_id, '_occasion_hashtag', 				$occasion_hashtag );
	update_post_meta( $post_id, '_occasion_twitter', 				$occasion_twitter );
	update_post_meta( $post_id, '_occasion_facebook', 				$occasion_facebook );
	update_post_meta( $post_id, '_occasion_facebook_event', 		$occasion_facebook_event );
	update_post_meta( $post_id, '_occasion_google', 				$occasion_google );
	update_post_meta( $post_id, '_occasion_google_event', 			$occasion_google_event );
	update_post_meta( $post_id, '_occasion_lanyrd', 				$occasion_lanyrd );
	update_post_meta( $post_id, '_occasion_meetup', 				$occasion_meetup );
}
add_action( 'save_post', 'occasion_event_information_handle_post_data' );
?>