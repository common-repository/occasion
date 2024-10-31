<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Custom meta box for event values
 * 
 */
function occasion_event_values_meta_box() {

	// Only add the box to the selected post types
	$screens 		= array();
	$post_types 	= get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_event_values_on_' . $post_type ) === 'show' )
		{
			array_push( $screens, $post_type );
		}
	}

	foreach ( $screens as $screen ) 
	{
		add_meta_box(
			'occasion_event',
			'Event values',
			'occasion_event_values_render_meta_box',
			$screen,
			'side',
			'high'
		);
	}

}
add_action( 'add_meta_boxes', 'occasion_event_values_meta_box' );


/**
 * 
 * @since  		1.0.0
 * 
 * Render the event values meta box
 * 
 */
function occasion_event_values_render_meta_box( $post ) {

	$occasion_start_date 	= get_post_meta( $post->ID, '_occasion_start_date', true );
	$occasion_end_date 		= get_post_meta( $post->ID, '_occasion_end_date', true );
	$occasion_is_all_day 	= get_post_meta( $post->ID, '_occasion_is_all_day', true );
	$occasion_start_time 	= get_post_meta( $post->ID, '_occasion_start_time', true );
	$occasion_end_time 		= get_post_meta( $post->ID, '_occasion_end_time', true );
	$occasion_is_cancelled 	= get_post_meta( $post->ID, '_occasion_is_cancelled', true );

	if( empty( $occasion_is_all_day ) )
	{
		$occasion_is_all_day = 'true';
	}

	?>
		<div class="occasion_event cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_start_date">Start Date</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="date" id="occasion_start_date" name="occasion_start_date" value="<?php echo $occasion_start_date;?>"/>
					</div>
				</div>
			</p>
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_end_date">End Date</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="date" id="occasion_end_date" name="occasion_end_date" value="<?php echo $occasion_end_date;?>"/>
					</div>
				</div>
			</p>
		</div>

		<?php echo '</div><hr/><div class="inside">'; ?>

		<div class="occasion_event cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_is_all_day">All day event</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="checkbox" id="occasion_is_all_day" name="occasion_is_all_day" value="true"<?php echo ( $occasion_is_all_day == 'true') ? ' checked' : '';?>/>
					</div>
				</div>
			</p>
			
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_start_time">Start Time</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="time" id="occasion_start_time" name="occasion_start_time" value="<?php echo $occasion_start_time;?>"/>

					</div>
				</div>
			</p>
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_end_time">End Time</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="time" id="occasion_end_time" name="occasion_end_time" value="<?php echo $occasion_end_time;?>"/>
					</div>
				</div>
			</p>
			<p><em>If you want to use different start and end times for each day of the event, create multiple events.</em></p>
		</div>

		<?php echo '</div><hr/><div class="inside">'; ?>

		<div class="occasion_event cf">	
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_is_cancelled">Cancelled</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="checkbox" id="occasion_is_cancelled" name="occasion_is_cancelled" value="true"<?php echo ( $occasion_is_cancelled == 'true') ? ' checked' : '';?>/>	
					</div>
				</div>
			</p>
			<p><em>Check the cancelled box if you want to cancel the event, but still advise your customers</em></p>
		</div>

	<?php

	wp_nonce_field( 'submit_occasion_event_values', 'occasion_event_values_nonce' ); 
}


/**
 * 
 * @since  		1.0.0
 * 
 * Handle the event values meta box post data
 * 
 */
function occasion_event_values_handle_post_data( $post_id )
{
	$nonce_key							= 'occasion_event_values_nonce';
	$nonce_action						= 'submit_occasion_event_values';

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

	$occasion_start_date 	= isset( $_POST['occasion_start_date'] )	? $_POST['occasion_start_date'] : null;
	$occasion_end_date 		= isset( $_POST['occasion_end_date'] )		? $_POST['occasion_end_date'] : null;
	$occasion_is_all_day 	= isset( $_POST['occasion_is_all_day'] )	? 'true' : 'false';
	$occasion_start_time 	= isset( $_POST['occasion_start_time'] ) 	? $_POST['occasion_start_time'] : null;
	$occasion_end_time 		= isset( $_POST['occasion_end_time'] )		? $_POST['occasion_end_time'] : null;
	$occasion_is_cancelled 	= isset( $_POST['occasion_is_cancelled'] )	? 'true' : 'false';

	if( !empty( $occasion_start_date ) )
	{
		if( empty( $occasion_end_date ) )
		{
			$occasion_end_date =  $occasion_start_date;
		}

		if ( $occasion_end_date < $occasion_start_date )
		{
			$occasion_end_date =  $occasion_start_date;
		}
	}

	if( $occasion_is_all_day == 'true' )
	{
		$occasion_start_time 	= null;
		$occasion_end_time 		= null;
	}

	if( !empty( $occasion_start_time ) )
	{
		if( empty( $occasion_end_time ) )
		{
			$occasion_end_time =  $occasion_start_time;
		}
	}

	update_post_meta( $post_id, '_occasion_start_date', 	$occasion_start_date );
	update_post_meta( $post_id, '_occasion_end_date', 		$occasion_end_date );
	update_post_meta( $post_id, '_occasion_is_all_day', 	$occasion_is_all_day );
	update_post_meta( $post_id, '_occasion_is_cancelled', 	$occasion_is_cancelled );
	update_post_meta( $post_id, '_occasion_start_time', 	$occasion_start_time );
	update_post_meta( $post_id, '_occasion_end_time', 		$occasion_end_time );
}
add_action( 'save_post', 'occasion_event_values_handle_post_data' );
?>