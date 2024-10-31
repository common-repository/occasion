<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.2.0
 * 
 * Custom meta box for eventbrite
 * 
 */
function occasion_recurring_meta_box() {

	// Only add the box to the selected post types
	$screens 		= array();
	$post_types 	= get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_recurring_on_' . $post_type ) === 'show' )
		{
			array_push( $screens, $post_type );
		}
	}

	foreach ( $screens as $screen ) 
	{
		add_meta_box(
			'occasion_recurring',
			'Recurring event options',
			'occasion_recurring_render_meta_box',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'occasion_recurring_meta_box' );



/**
 * 
 * @since  		1.2.0
 * 
 * Render the eventbrite meta box
 * 
 */
function occasion_recurring_render_meta_box( $post ) {

	$date 										= date('Y-m-d');
	$occasion_is_recurring 						= get_post_meta( $post->ID, '_occasion_is_recurring', true );
	$occasion_is_recursion						= ( $post->post_parent != 0 );
	$occasion_recurance_pattern 				= get_post_meta( $post->ID, '_occasion_recurance_pattern', true );
	$occasion_recurance_week_pattern 			= get_post_meta( $post->ID, '_occasion_recurance_week_pattern', true );
	$occasion_recurance_week_monday				= get_post_meta( $post->ID, '_occasion_recurance_week_monday', true );
	$occasion_recurance_week_tuesday			= get_post_meta( $post->ID, '_occasion_recurance_week_tuesday', true );
	$occasion_recurance_week_wednesday			= get_post_meta( $post->ID, '_occasion_recurance_week_wednesday', true );
	$occasion_recurance_week_thursday			= get_post_meta( $post->ID, '_occasion_recurance_week_thursday', true );
	$occasion_recurance_week_friday				= get_post_meta( $post->ID, '_occasion_recurance_week_friday', true );
	$occasion_recurance_week_saturday			= get_post_meta( $post->ID, '_occasion_recurance_week_saturday', true );
	$occasion_recurance_week_sunday				= get_post_meta( $post->ID, '_occasion_recurance_week_sunday', true );
	$occasion_recurance_month_pattern 			= get_post_meta( $post->ID, '_occasion_recurance_month_pattern', true );
	$occasion_recurance_month_day 				= get_post_meta( $post->ID, '_occasion_recurance_month_day', true );
	$occasion_recurance_month_frequency 		= get_post_meta( $post->ID, '_occasion_recurance_month_frequency', true );
	$occasion_recurance_month_day_fequency		= get_post_meta( $post->ID, '_occasion_recurance_month_day_fequency', true );
	$occasion_recurance_month_day_name			= get_post_meta( $post->ID, '_occasion_recurance_month_day_name', true );
	$occasion_recurance_month_frequency_complex	= get_post_meta( $post->ID, '_occasion_recurance_month_frequency_complex', true );
	$occasion_recurring_create_from				= get_post_meta( $post->ID, '_occasion_recurring_create_from', true );
	$occasion_recurring_create_to				= get_post_meta( $post->ID, '_occasion_recurring_create_to', true );

	if( empty( $occasion_recurance_pattern ) )
	{
		$occasion_recurance_pattern = 'weekly';
	}

	if( !is_numeric( $occasion_recurance_week_pattern ) || $occasion_recurance_week_pattern > 52 )
	{
		$occasion_recurance_week_pattern = 0;
	}

	if( !is_numeric( $occasion_recurance_month_day ) || $occasion_recurance_month_day > 31 )
	{
		$occasion_recurance_month_day = 0;
	}

	if( !is_numeric( $occasion_recurance_month_frequency ) || $occasion_recurance_month_frequency > 12 )
	{
		$occasion_recurance_month_frequency = 0;
	}

	if( !is_numeric( $occasion_recurance_month_frequency_complex ) || $occasion_recurance_month_frequency_complex > 12 )
	{
		$occasion_recurance_month_frequency_complex = 0;
	}

	if( empty( $occasion_recurring_create_from ) )
	{
		$occasion_recurring_create_from = $date;
	}

	if( empty( $occasion_recurring_create_to ) )
	{
		$occasion_recurring_create_to = date( 'Y-m-d', strtotime( $date . ' + 12 months') );
	}

	if( $occasion_recurring_create_to < $occasion_recurring_create_from )
	{
		$occasion_recurring_create_to = $occasion_recurring_create_from;
	}

	?>
		<div class="occasion_recurring cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_is_recurring">Recurring event</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="checkbox" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" id="occasion_is_recurring" name="occasion_is_recurring" value="true"<?php echo ( $occasion_is_recurring == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?>/>
					</div>
				</div>
			</p>
		</div>

		<?php echo '</div><hr/><div class="inside">'; ?>

		<div class="occasion_recurring cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							Recurance pattern
						</strong>
					</div>
					<div class="input__container">
							<input type="radio" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" id="occasion_recurance_pattern_weekly" name="occasion_recurance_pattern" value="weekly"<?php echo ( $occasion_recurance_pattern == 'weekly') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?>/>
							<label for="occasion_recurance_pattern_weekly">Weekly</label>
							<br/>
							<input type="radio" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" id="occasion_recurance_pattern_monthly" name="occasion_recurance_pattern" value="monthly"<?php echo ( $occasion_recurance_pattern == 'monthly') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?>/>
							<label for="occasion_recurance_pattern_monthly">Monthly</label>
					</div>
				</div>
			</p>
		</div>

		<?php echo '</div><hr/><div class="inside">'; ?>

		<div class="occasion_recurring cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_is_recurring_weekly">Weekly</label>
						</strong>
					</div>
					<div class="input__container occasion_recurring_weekly">
						<label class="screen-reader-text" for="occasion_recurance_week_pattern">Repeat every x weeks</label> 
						Repeat every <input class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" id="occasion_recurance_week_pattern" name="occasion_recurance_week_pattern" type="text"<?php echo ( $occasion_is_recurring == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="<?php echo $occasion_recurance_week_pattern;?>"/> weeks on a:
						<br/><br/>
						<input id="occasion_recurance_week_monday" name="occasion_recurance_week_monday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_monday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_monday">Monday</label><br/>
						<input id="occasion_recurance_week_tuesday" name="occasion_recurance_week_tuesday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_tuesday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_tuesday">Tuesday</label><br/>
						<input id="occasion_recurance_week_wednesday" name="occasion_recurance_week_wednesday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_wednesday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_wednesday">Wednesday</label><br/>
						<input id="occasion_recurance_week_thursday" name="occasion_recurance_week_thursday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_thursday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_thursday">Thursday</label><br/>
						<input id="occasion_recurance_week_friday" name="occasion_recurance_week_friday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_friday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_friday">Friday</label><br/>
						<input id="occasion_recurance_week_saturday" name="occasion_recurance_week_saturday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_saturday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_saturday">Saturday</label><br/>
						<input id="occasion_recurance_week_sunday" name="occasion_recurance_week_sunday" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="checkbox"<?php echo ( $occasion_recurance_week_sunday == 'true') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="true"/> <label for="occasion_recurance_week_sunday">Sunday</label><br/>
					</div>
				</div>
			</p>
		</div> 

		<?php echo '</div><hr/><div class="inside">'; ?>

		<div class="occasion_recurring cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_is_recurring_weekly">Monthly</label>
						</strong>
					</div>
					<div class="input__container occasion_recurring_monthly">
							<label class="screen-reader-text" for="occasion_recurance_month_pattern_day">Repeat every x day of month</label> 
							<input id="occasion_recurance_month_pattern_day" name="occasion_recurance_month_pattern" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="radio"<?php echo ( $occasion_recurance_month_pattern == 'day') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="day"/> 
							<label class="screen-reader-text" for="occasion_recurance_month_day">Day of the month</label> 
							Day <input id="occasion_recurance_month_day" name="occasion_recurance_month_day" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="text"<?php echo $occasion_is_recursion ? ' disabled' : '';?> value="<?php echo $occasion_recurance_month_day;?>"/> 
							<label class="screen-reader-text" for="occasion_recurance_month_frequency">Frequency of months</label> 
							of every <input id="occasion_recurance_month_frequency" name="occasion_recurance_month_frequency" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="text"<?php echo $occasion_is_recursion ? ' disabled' : '';?> value="<?php echo $occasion_recurance_month_frequency;?>"/> 
							month(s)

							<br/><br/>
							
							<label class="screen-reader-text" for="occasion_recurance_month_pattern_complex">Repeat every first, second, third or last x day of month</label> 
							<input id="occasion_recurance_month_pattern_complex" name="occasion_recurance_month_pattern" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="radio"<?php echo ( $occasion_recurance_month_pattern == 'complex') ? ' checked' : '';?><?php echo $occasion_is_recursion ? ' disabled' : '';?> value="complex"/> 
							The 
							<label class="screen-reader-text" for="occasion_recurance_month_day_fequency">Month day frequency</label> 
							<select id="occasion_recurance_month_day_fequency" name="occasion_recurance_month_day_fequency" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>"<?php echo $occasion_is_recursion ? ' disabled' : '';?>>
							<option value="first"<?php echo ( $occasion_recurance_month_day_fequency == 'first' ) ? ' selected' : '';?>>First</option>
							<option value="second"<?php echo ( $occasion_recurance_month_day_fequency == 'second' ) ? ' selected' : '';?>>Second</option>
							<option value="third"<?php echo ( $occasion_recurance_month_day_fequency == 'third' ) ? ' selected' : '';?>>Third</option>
							<option value="last"<?php echo ( $occasion_recurance_month_day_fequency == 'last' ) ? ' selected' : '';?>>Last</option>
							</select>
							<label class="screen-reader-text" for="occasion_recurance_month_day_name">Week day name</label> 
							<select id="occasion_recurance_month_day_name" name="occasion_recurance_month_day_name" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>"<?php echo $occasion_is_recursion ? ' disabled' : '';?>>
							<option value="monday"<?php echo ( $occasion_recurance_month_day_name == 'monday' ) ? ' selected' : '';?>>Monday</option>
							<option value="tuesday"<?php echo ( $occasion_recurance_month_day_name == 'tuesday' ) ? ' selected' : '';?>>Tuesday</option>
							<option value="wednesday"<?php echo ( $occasion_recurance_month_day_name == 'wednesday' ) ? ' selected' : '';?>>Wednesday</option>
							<option value="thursday"<?php echo ( $occasion_recurance_month_day_name == 'thursday' ) ? ' selected' : '';?>>Thursday</option>
							<option value="friday"<?php echo ( $occasion_recurance_month_day_name == 'friday' ) ? ' selected' : '';?>>Friday</option>
							<option value="saturday"<?php echo ( $occasion_recurance_month_day_name == 'saturday' ) ? ' selected' : '';?>>Saturday</option>
							<option value="sunday"<?php echo ( $occasion_recurance_month_day_name == 'sunday' ) ? ' selected' : '';?>>Sunday</option>
							</select> 
							<label class="screen-reader-text" for="occasion_recurance_month_frequency_complex">Frequency of months</label> 
							of every <input id="occasion_recurance_month_frequency_complex" name="occasion_recurance_month_frequency_complex" class="<?php echo $occasion_is_recursion ? 'disabled' : '';?>" type="text"<?php echo $occasion_is_recursion ? ' disabled' : '';?> value="<?php echo $occasion_recurance_month_frequency_complex;?>"/>  
							month(s)
					</div>
				</div>
			</p>
		</div> 

		<?php echo '</div><hr/><div class="inside">'; ?>

		<div class="occasion_recurring occasion_recurring_from_to cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							Create recurring from
						</strong>
					</div>
					<div class="input__container">
							<input type="date" id="occasion_recurring_create_from" name="occasion_recurring_create_from" value="<?php echo $occasion_recurring_create_from;?>"/>
					</div>
				</div>
			</p>
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							Create recurring to
						</strong>
					</div>
					<div class="input__container">
							<input type="date" id="occasion_recurring_create_to" name="occasion_recurring_create_to" value="<?php echo $occasion_recurring_create_to;?>"/>
					</div>
				</div>
			</p>
			<p><em>Please note that if you have already created occuring events, and moved the date of any of those events, if you change the 'Create recurring from' date to before these events occur then the original event occurance will be created again.</em></p>
		</div> 

	<?php

	wp_nonce_field( 'submit_occasion_recurring', 'occasion_recurring_nonce' ); 
}


/**
 * 
 * @since  		1.2.0
 * 
 * Handle the eventbrite meta box post data
 * 
 */
function occasion_recurring_handle_post_data( $post_id )
{
	$nonce_key							= 'occasion_recurring_nonce';
	$nonce_action						= 'submit_occasion_recurring';

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

	$post 										= get_post( $post_id );
	$date 										= date('Y-m-d');
	$occasion_is_recurring 						= isset( $_POST['occasion_is_recurring'] ) 	? 'true' : 'false';
	$occasion_is_recursion						= ( $post->post_parent != 0 );
	$occasion_recurance_pattern 				= isset( $_POST['occasion_recurance_pattern'] ) 				?  $_POST['occasion_recurance_pattern']			 		: null;
	$occasion_recurance_week_pattern 			= isset( $_POST['occasion_recurance_week_pattern'] ) 			?  $_POST['occasion_recurance_week_pattern']		 	: null;
	$occasion_recurance_week_monday				= isset( $_POST['occasion_recurance_week_monday'] ) 			?  $_POST['occasion_recurance_week_monday']				: null;
	$occasion_recurance_week_tuesday			= isset( $_POST['occasion_recurance_week_tuesday'] ) 			?  $_POST['occasion_recurance_week_tuesday']			: null;
	$occasion_recurance_week_wednesday			= isset( $_POST['occasion_recurance_week_wednesday'] ) 			?  $_POST['occasion_recurance_week_wednesday']			: null;
	$occasion_recurance_week_thursday			= isset( $_POST['occasion_recurance_week_thursday'] ) 			?  $_POST['occasion_recurance_week_thursday']			: null;
	$occasion_recurance_week_friday				= isset( $_POST['occasion_recurance_week_friday'] ) 			?  $_POST['occasion_recurance_week_friday']				: null;
	$occasion_recurance_week_saturday			= isset( $_POST['occasion_recurance_week_saturday'] ) 			?  $_POST['occasion_recurance_week_saturday']			: null;
	$occasion_recurance_week_sunday				= isset( $_POST['occasion_recurance_week_sunday'] ) 			?  $_POST['occasion_recurance_week_sunday']				: null;
	$occasion_recurance_month_pattern 			= isset( $_POST['occasion_recurance_month_pattern'] ) 			?  $_POST['occasion_recurance_month_pattern']			: null;
	$occasion_recurance_month_day 				= isset( $_POST['occasion_recurance_month_day'] ) 				?  $_POST['occasion_recurance_month_day']				: null;
	$occasion_recurance_month_frequency 		= isset( $_POST['occasion_recurance_month_frequency'] ) 		?  $_POST['occasion_recurance_month_frequency']			: null;
	$occasion_recurance_month_day_fequency		= isset( $_POST['occasion_recurance_month_day_fequency'] ) 		?  $_POST['occasion_recurance_month_day_fequency']		: null;
	$occasion_recurance_month_day_name			= isset( $_POST['occasion_recurance_month_day_name'] ) 			?  $_POST['occasion_recurance_month_day_name'] 			: null;
	$occasion_recurance_month_frequency_complex	= isset( $_POST['occasion_recurance_month_frequency_complex'] ) ?  $_POST['occasion_recurance_month_frequency_complex'] : null;
	$occasion_recurring_create_from				= isset( $_POST['occasion_recurring_create_from'] ) 			?  $_POST['occasion_recurring_create_from']				: null;
	$occasion_recurring_create_to				= isset( $_POST['occasion_recurring_create_to'] ) 				?  $_POST['occasion_recurring_create_to']				: null;
	$occasion_start_date 						= get_post_meta( $post->ID, '_occasion_start_date', true );
	$occasion_end_date 							= get_post_meta( $post->ID, '_occasion_end_date', true );
	$occasion_start_end_diff 					= 0;

	if( empty( $occasion_start_date ) )
	{
		$occasion_start_date = $date;
	}

	if( empty( $occasion_end_date ) || $occasion_end_date < $occasion_start_date )
	{
		$occasion_end_date = $date;
	}

	if( !empty( $occasion_start_date ) && !empty( $occasion_end_date ) )
	{
		$occasion_start_end_diff = strtotime( $occasion_end_date ) - strtotime( $occasion_start_date );
		$occasion_start_end_diff = floor( $occasion_start_end_diff/3600/24 );
	} 

	if( !is_numeric( $occasion_recurance_week_pattern ) || $occasion_recurance_week_pattern < 1 )
	{
		$occasion_recurance_week_pattern = 1;
	}
	else if( $occasion_recurance_week_pattern > 52 )
	{
		$occasion_recurance_week_pattern = 52;
	}

	if( !is_numeric( $occasion_recurance_month_day ) || $occasion_recurance_month_day < 1 )
	{
		$occasion_recurance_month_day = 1;
	}
	else if( $occasion_recurance_month_day > 31 )
	{
		$occasion_recurance_month_day = 31;
	}

	if( !is_numeric( $occasion_recurance_month_frequency ) || $occasion_recurance_month_frequency < 1 )
	{
		$occasion_recurance_month_frequency = 1;
	}
	else if( $occasion_recurance_month_frequency > 12 )
	{
		$occasion_recurance_month_frequency = 12;
	}

	if( !is_numeric( $occasion_recurance_month_frequency_complex ) || $occasion_recurance_month_frequency_complex < 1 )
	{
		$occasion_recurance_month_frequency_complex = 1;
	}
	else if( $occasion_recurance_month_frequency_complex > 12 )
	{
		$occasion_recurance_month_frequency_complex = 12;
	}

	if(	get_post_status( $post_id ) == 'publish' && $occasion_is_recurring == 'true' && $post->post_parent == 0 && !empty( $occasion_recurring_create_from ) && !empty( $occasion_recurring_create_to ) )
	{

		if( $occasion_recurance_pattern == 'weekly' )
		{
			if( $occasion_recurance_week_monday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'monday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}

			if( $occasion_recurance_week_tuesday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'tuesday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}

			if( $occasion_recurance_week_wednesday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'wednesday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}

			if( $occasion_recurance_week_thursday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'thursday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}

			if( $occasion_recurance_week_friday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'friday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}

			if( $occasion_recurance_week_saturday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'saturday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}

			if( $occasion_recurance_week_sunday == 'true' )
			{
				occasion_helper_create_occurance_by_week_day( 'sunday', $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date );
			}
		}
		else if( $occasion_recurance_pattern == 'monthly' )
		{
			if( $occasion_recurance_month_pattern == 'day' )
			{
				$child_start_dates 	= array();
				$child_args = array(
					'post_parent' 		=> $post_id,
					'post_type' 		=> get_post_type( $post_id ),
					'post_status' 		=> array('publish', 'occasion_recurring') ,
					'posts_per_page'	=> -1, 
				);
				$children = get_posts( $child_args );

				foreach( $children as $child )
				{
					$child_start_date = get_post_meta( $child->ID, '_occasion_start_date', true );
					if( !empty( $child_start_date ) )
					{
						array_push( $child_start_dates, $child_start_date );
					}
				}
				$start_month 	= date( 'm', strtotime( $occasion_recurring_create_from ) );
				$start_year  	= date( 'Y', strtotime( $occasion_recurring_create_from ) );
				$start_day		= $occasion_recurance_month_day;
				if( cal_days_in_month(CAL_GREGORIAN, $start_month, $start_year ) < $start_day )
				{
					$start_day = cal_days_in_month(CAL_GREGORIAN, $start_month, $start_year );
				}
				$start_date 	= date( 'Y-m-d', strtotime( $start_year . '-' . $start_month . '-' . $start_day ) );

				while( $start_date < $occasion_recurring_create_to )
				{
					$end_date = date( 'Y-m-d', strtotime( $start_date . ' + ' . $occasion_start_end_diff . ' days' ) );

					if( $start_date != $occasion_start_date && !in_array( $start_date, $child_start_dates ) )
					{
						occasion_helper_create_occurance( $post_id, $start_date, $end_date );
					}

					$start_month 	= date( 'm', strtotime( $start_date ) ) + $occasion_recurance_month_frequency;
					$start_year  	= date( 'Y', strtotime( $start_date ) );
					$start_day		= $occasion_recurance_month_day;
					
					if( $start_month > 12)
					{
						$start_year = $start_year + 1;
						$start_month = $start_month - 12;
					}

					if( cal_days_in_month(CAL_GREGORIAN, $start_month, $start_year ) < $start_day )
					{
						$start_day = cal_days_in_month(CAL_GREGORIAN, $start_month, $start_year );
					}

					$start_date 	= date( 'Y-m-d', strtotime( $start_year . '-' . $start_month . '-' . $start_day ) );
				}
			}
			else if( $occasion_recurance_month_pattern == 'complex' )
			{
				$start_date 		= new DateTime( $occasion_recurring_create_from );
				$start_month 		= date( 'm', strtotime( $start_date->format('Y-m-d') ) ) + $occasion_recurance_month_frequency_complex;
				$start_year  		= date( 'Y', strtotime( $start_date->format('Y-m-d') ) );
				$month_name 		= date("F", mktime( 0, 0, 0, $start_month, 10 ) );
				$child_start_dates 	= array();
				$child_args 		= array(
					'post_parent' 		=> $post_id,
					'post_type' 		=> get_post_type( $post_id ),
					'post_status' 		=> array('publish', 'occasion_recurring'),
					'posts_per_page'	=> -1, 
				);
				$children = get_posts( $child_args );

				foreach( $children as $child )
				{
					$child_start_date = get_post_meta( $child->ID, '_occasion_start_date', true );
					
					if( !empty( $child_start_date ) )
					{
						array_push( $child_start_dates, $child_start_date );
					}
				}

				if( $occasion_recurance_month_day_fequency != 'last' )
				{
					$start_date = $start_date->modify( $occasion_recurance_month_day_fequency .' '. $occasion_recurance_month_day_name )->format('Y-m-d');
				}
				else if( $occasion_recurance_month_day_fequency == 'last' )
				{
					$start_date = date( 'Y-m-d', strtotime('last '. $occasion_recurance_month_day_name .' of '. $month_name .' '. $start_year ) );
				}

				while( $start_date < $occasion_recurring_create_to )
				{
					$end_date = date( 'Y-m-d', strtotime( $start_date . ' + ' . $occasion_start_end_diff . ' days' ) );

					if( $start_date != $occasion_start_date && !in_array( $start_date, $child_start_dates ) )
					{
						occasion_helper_create_occurance( $post_id, $start_date, $end_date );
					}

					$start_month 	= date( 'm', strtotime( $start_date ) ) + $occasion_recurance_month_frequency_complex;
					$start_year  	= date( 'Y', strtotime( $start_date ) );

					if( $start_month > 12)
					{
						$start_year 	= $start_year + 1;
						$start_month 	= $start_month - 12;
					}
					$month_name 	= date("F", mktime( 0, 0, 0, $start_month, 10 ) );
					$start_date 	= date( 'Y-m-d', strtotime( $start_year . '-' . $start_month . '-01' ) );
					$start_date 	= new DateTime( $start_date );

					if( $occasion_recurance_month_day_fequency != 'last' )
					{
						$start_date = $start_date->modify( $occasion_recurance_month_day_fequency .' '. $occasion_recurance_month_day_name )->format('Y-m-d');
					}
					else if( $occasion_recurance_month_day_fequency == 'last' )
					{
						$start_date = date( 'Y-m-d', strtotime('last '. $occasion_recurance_month_day_name .' of '. $month_name .' '. $start_year ) );
					}
				}
			}
		}
	}

	update_post_meta( $post_id, '_occasion_is_recurring', 						$occasion_is_recurring );
	update_post_meta( $post_id, '_occasion_recurance_pattern', 					$occasion_recurance_pattern );
	update_post_meta( $post_id, '_occasion_recurance_week_pattern', 			$occasion_recurance_week_pattern );
	update_post_meta( $post_id, '_occasion_recurance_week_monday', 				$occasion_recurance_week_monday );
	update_post_meta( $post_id, '_occasion_recurance_week_tuesday', 			$occasion_recurance_week_tuesday );
	update_post_meta( $post_id, '_occasion_recurance_week_wednesday',	 		$occasion_recurance_week_wednesday );
	update_post_meta( $post_id, '_occasion_recurance_week_thursday', 			$occasion_recurance_week_thursday );
	update_post_meta( $post_id, '_occasion_recurance_week_friday', 				$occasion_recurance_week_friday );
	update_post_meta( $post_id, '_occasion_recurance_week_saturday', 			$occasion_recurance_week_saturday );
	update_post_meta( $post_id, '_occasion_recurance_week_sunday', 				$occasion_recurance_week_sunday );
	update_post_meta( $post_id, '_occasion_recurance_month_pattern', 			$occasion_recurance_month_pattern );
	update_post_meta( $post_id, '_occasion_recurance_month_day', 				$occasion_recurance_month_day );
	update_post_meta( $post_id, '_occasion_recurance_month_frequency', 			$occasion_recurance_month_frequency );
	update_post_meta( $post_id, '_occasion_recurance_month_day_fequency', 		$occasion_recurance_month_day_fequency );
	update_post_meta( $post_id, '_occasion_recurance_month_day_name', 			$occasion_recurance_month_day_name );
	update_post_meta( $post_id, '_occasion_recurance_month_frequency_complex',	$occasion_recurance_month_frequency_complex );
	update_post_meta( $post_id, '_occasion_recurring_create_from', 				$occasion_recurring_create_from );
	update_post_meta( $post_id, '_occasion_recurring_create_to', 				$occasion_recurring_create_to );
}

add_action( 'save_post', 'occasion_recurring_handle_post_data' );

function occasion_helper_create_occurance( $post_id, $start_date, $end_date )
{

	global $wpdb;

	$parent_post = get_post( $post_id );
	$post_args = array(
		'post_title'		=> $parent_post->post_title,
		'post_type'			=> $parent_post->post_type,
		'post_parent'		=> $post_id,
		'post_status'		=> 'occasion_recurring',
		'comment_status'	=> $parent_post->comment_status,
		'ping_status'		=> $parent_post->ping_status,
		'post_content'		=> $parent_post->post_content,
		'post_excerpt'		=> $parent_post->post_excerpt,
		'post_name'			=> $parent_post->post_name,
		'post_password'		=> $parent_post->post_password,
		'to_ping'			=> $parent_post->to_ping,
	); 

	$insert_id = wp_insert_post( $post_args );

	$taxonomies = get_object_taxonomies($parent_post->post_type);
	foreach ($taxonomies as $taxonomy) {
		$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
		wp_set_object_terms($insert_id, $post_terms, $taxonomy, false);
	}

	$post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id" );
	if (count( $post_meta_infos )!=0) 
	{
		$sql_query = "INSERT INTO $wpdb->postmeta ( post_id, meta_key, meta_value ) ";
		foreach ( $post_meta_infos as $meta_info ) 
		{
			$meta_key = $meta_info->meta_key;
			$meta_value = addslashes( $meta_info->meta_value );
			$sql_query_sel[]= "SELECT $insert_id, '$meta_key', '$meta_value'";
		}
		$sql_query.= implode(" UNION ALL ", $sql_query_sel);
		$wpdb->query( $sql_query );
	}

	update_post_meta( $insert_id, '_occasion_start_date', 	$start_date );
	update_post_meta( $insert_id, '_occasion_end_date', 	$end_date );
}

function occasion_helper_create_occurance_by_week_day( $day, $post_id, $occasion_recurring_create_from, $occasion_recurring_create_to, $occasion_recurance_week_pattern, $occasion_start_end_diff, $occasion_start_date )
{
	$start_date 		= $occasion_recurring_create_from;
	$start_date 		= date( 'Y-m-d', strtotime( 'last ' . $day, strtotime( $start_date ) ) );
	$start_date 		= date( 'Y-m-d', strtotime( $start_date . ' + 7 days' ) );
	$child_start_dates 	= array();
	$child_args = array(
		'post_parent' 		=> $post_id,
		'post_type' 		=> get_post_type( $post_id ),
		'post_status' 		=> array('publish', 'occasion_recurring') ,
		'posts_per_page'	=> -1, 
	);
	$children = get_posts( $child_args );

	foreach( $children as $child )
	{
		$child_start_date = get_post_meta( $child->ID, '_occasion_start_date', true );
		if( !empty( $child_start_date ) )
		{
			array_push( $child_start_dates, $child_start_date );
		}
	}

	if( $occasion_recurance_week_pattern > 0)
	{
		$week_multiplier = 7 * $occasion_recurance_week_pattern;

		while( $start_date < $occasion_recurring_create_to )
		{
			$end_date = date( 'Y-m-d', strtotime( $start_date . ' + ' . $occasion_start_end_diff . ' days' ) );

			if( $start_date != $occasion_start_date && !in_array( $start_date, $child_start_dates ) )
			{
				occasion_helper_create_occurance( $post_id, $start_date, $end_date );
			}

			$start_date =  date( 'Y-m-d', strtotime( $start_date . ' +  '. $week_multiplier . ' days' ) );
		}
	}
}

?>