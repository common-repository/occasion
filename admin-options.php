<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Register the options page
 * 
 */
function occasion_add_options_page() {

	add_options_page( 'Occasion', 'Occasion', 'manage_options', 'occasion-settings', 'occasion_render_options_page' );

	add_action( 'admin_init', 'occasion_register_settings' );
}
add_action('admin_menu', 'occasion_add_options_page');




/**
 * 
 * @since  		1.0.0
 * 
 * Register the options settings
 * 
 */
function occasion_register_settings() {

	$post_types = get_post_types( array('public' => true) );

	register_setting( 'occasion_group', '_occasion_show_events_cpt' );
	register_setting( 'occasion_group', '_occasion_show_url' );
	register_setting( 'occasion_group', '_occasion_show_email' );
	register_setting( 'occasion_group', '_occasion_show_sms' );
	register_setting( 'occasion_group', '_occasion_show_sms_instructions' );
	register_setting( 'occasion_group', '_occasion_show_telephone' );
	register_setting( 'occasion_group', '_occasion_show_hashtag' );
	register_setting( 'occasion_group', '_occasion_show_twitter' );
	register_setting( 'occasion_group', '_occasion_show_facebook' );
	register_setting( 'occasion_group', '_occasion_show_facebook_event' );
	register_setting( 'occasion_group', '_occasion_show_google' );
	register_setting( 'occasion_group', '_occasion_show_google_event' );
	register_setting( 'occasion_group', '_occasion_show_lanyrd' );
	register_setting( 'occasion_group', '_occasion_show_meetup' );

	foreach( $post_types as $post_type)
	{
		register_setting( 'occasion_group', '_occasion_show_event_values_on_' . $post_type );
		register_setting( 'occasion_group', '_occasion_show_event_information_on_' . $post_type );
		register_setting( 'occasion_group', '_occasion_show_recurring_on_' . $post_type );
		register_setting( 'occasion_group', '_occasion_show_eventbrite_on_' . $post_type );
	}

}

/**
 * 
 * @since  		1.0.0
 * 
 * Render the options page
 * 
 */
function occasion_render_options_page()
{	
	$post_types 		= get_post_types( array('public' => true) );
	sort( $post_types );

	foreach( $post_types as $post_type)
	{
		if($post_type == 'occasion_events')
		{
			if( get_option('_occasion_show_event_values_on_' . $post_type ) === false )
			{
				add_option( '_occasion_show_event_values_on_' . $post_type, 'show' );
			}

			if( get_option('_occasion_show_event_information_on_' . $post_type ) === false )
			{
				add_option( '_occasion_show_event_information_on_' . $post_type, 'show' );
			}

			if( get_option('_occasion_show_eventbrite_on_' . $post_type ) === false )
			{
				add_option( '_occasion_show_eventbrite_on_' . $post_type, 'show' );
			}

			if( get_option('_occasion_show_recurring_on_' . $post_type ) === false )
			{
				add_option( '_occasion_show_recurring_on_' . $post_type, 'show' );
			}
		}
	}

	if( get_option('_occasion_show_events_cpt') === false)
	{
		add_option( '_occasion_show_events_cpt', 'show' );
	}

	if( get_option('_occasion_show_url') === false)
	{
		add_option( '_occasion_show_url', 'true' );
	}

	if( get_option('_occasion_show_email') === false)
	{
		add_option( '_occasion_show_email', 'true' );
	}

	if( get_option('_occasion_show_telephone') === false)
	{
		add_option( '_occasion_show_telephone', 'true' );
	}

	if( get_option('_occasion_show_hashtag') === false)
	{
		add_option( '_occasion_show_hashtag', 'true' );
	}

	if( get_option('_occasion_show_twitter') === false)
	{
		add_option( '_occasion_show_twitter', 'true' );
	}

	if( get_option('_occasion_show_facebook') === false)
	{
		add_option( '_occasion_show_facebook', 'true' );
	}

	?>
		<div class="wrap occasion_options">
			<h2>Occasion</h2>
			<form method="post" action="options.php">
			<?php 
				settings_fields( 'occasion_group' );
				do_settings_sections( 'occasion_group' );
			?>
			<table class="form-table">

				<tr valign="top">
					<th scope="row"><label for="occasion_show_events_cpt">Show the 'Products' post type</label></th>
					<td><input type="checkbox" value="show" id="occasion_show_events_cpt" name="_occasion_show_events_cpt"<?php echo ( get_option('_occasion_show_events_cpt') == 'show' ) ? ' checked' : '';?>></td>
				</tr>
				<tr valign="top">
					<th scope="row">Show 'Event values' custom meta on post type</th>
					<td>
						<?php
							foreach( $post_types as $post_type)
							{
								?>
									<span class="inline">
										<input type="checkbox" value="show" id="occasion_show_event_values_on_<?php echo $post_type;?>" name="_occasion_show_event_values_on_<?php echo $post_type;?>"<?php echo ( get_option('_occasion_show_event_values_on_' . $post_type ) == 'show' ) ? ' checked' : '';?>>
										<label for="occasion_show_event_values_on_<?php echo $post_type;?>">
										<?php
											
											$obj = get_post_type_object( $post_type );
											echo $obj->labels->singular_name;
										?>
										</label>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show 'Event information' custom meta on post type</th>
					<td>
						<?php
							foreach( $post_types as $post_type)
							{
								?>
									<span class="inline">
										<input type="checkbox" value="show" id="occasion_show_event_information_on_<?php echo $post_type;?>" name="_occasion_show_event_information_on_<?php echo $post_type;?>"<?php echo ( get_option('_occasion_show_event_information_on_' . $post_type ) == 'show' ) ? ' checked' : '';?>>
										<label for="occasion_show_event_information_on_<?php echo $post_type;?>">
										<?php
											
											$obj = get_post_type_object( $post_type );
											echo $obj->labels->singular_name;
										?>
										</label>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Event information fields</th>
					<td>
						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_url" name="_occasion_show_url"<?php echo ( get_option( '_occasion_show_url' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_url">
								Website URL
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_email" name="_occasion_show_email"<?php echo ( get_option( '_occasion_show_email' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_email">
								Email
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_sms" name="_occasion_show_sms"<?php echo ( get_option( '_occasion_show_sms' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_sms">
								SMS
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_sms_instructions" name="_occasion_show_sms_instructions"<?php echo ( get_option( '_occasion_show_sms_instructions' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_sms_instructions">
								SMS instructions
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_telephone" name="_occasion_show_telephone"<?php echo ( get_option( '_occasion_show_telephone' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_telephone">
								Telephone
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_hashtag" name="_occasion_show_hashtag"<?php echo ( get_option( '_occasion_show_hashtag' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_hashtag">
								Hashtag
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_twitter" name="_occasion_show_twitter"<?php echo ( get_option( '_occasion_show_twitter' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_twitter">
								Twitter
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_facebook" name="_occasion_show_facebook"<?php echo ( get_option( '_occasion_show_facebook' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_facebook">
								Facebook
							</label>
						</span>

						<span class="inline">
							<span class="inline">
								<input type="checkbox" value="true" id="occasion_show_facebook_event" name="_occasion_show_facebook_event"<?php echo ( get_option( '_occasion_show_facebook_event' ) == 'true' ) ? ' checked' : '';?>>
								<label for="occasion_show_facebook_event">
									Facebook event
								</label>
							</span>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_google" name="_occasion_show_google"<?php echo ( get_option( '_occasion_show_google' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_google">
								Google+
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_google_event" name="_occasion_show_google_event"<?php echo ( get_option( '_occasion_show_google_event' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_google_event">
								Google+ event
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_lanyrd" name="_occasion_show_lanyrd"<?php echo ( get_option( '_occasion_show_lanyrd' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_lanyrd">
								Lanyrd
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="occasion_show_meetup" name="_occasion_show_meetup"<?php echo ( get_option( '_occasion_show_meetup' ) == 'true' ) ? ' checked' : '';?>>
							<label for="occasion_show_meetup">
								Meetup
							</label>
						</span> 

					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show 'Eventbrite' custom meta on post type</th>
					<td>
						<?php
							foreach( $post_types as $post_type)
							{
								?>
									<span class="inline">
										<input type="checkbox" value="show" id="occasion_show_eventbrite_on_<?php echo $post_type;?>" name="_occasion_show_eventbrite_on_<?php echo $post_type;?>"<?php echo ( get_option('_occasion_show_eventbrite_on_' . $post_type ) == 'show' ) ? ' checked' : '';?>>
										<label for="occasion_show_eventbrite_on_<?php echo $post_type;?>">
										<?php
											
											$obj = get_post_type_object( $post_type );
											echo $obj->labels->singular_name;
										?>
										</label>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show 'Recurring' custom meta on post type</th>
					<td>
						<?php
							foreach( $post_types as $post_type)
							{
								?>
									<span class="inline">
										<input type="checkbox" value="show" id="occasion_show_recurring_on_<?php echo $post_type;?>" name="_occasion_show_recurring_on_<?php echo $post_type;?>"<?php echo ( get_option('_occasion_show_recurring_on_' . $post_type ) == 'show' ) ? ' checked' : '';?>>
										<label for="occasion_show_recurring_on_<?php echo $post_type;?>">
										<?php
											
											$obj = get_post_type_object( $post_type );
											echo $obj->labels->singular_name;
										?>
										</label>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
			</form>
		</div>
	<?php
}

/**
 * Add "Settings" action on installed plugin list
 */
function occasion_add_plugin_actions( $links ) {
	array_unshift( $links, '<a href="options-general.php?page=occasion-settings">Settings</a>');
	return $links;
}
add_action( 'plugin_action_links_occasion/index.php', 'occasion_add_plugin_actions' );

/**
 * Add links on installed plugin list
 */
function occasion_add_plugin_links( $links, $file ) 
{
	if( $file == 'occasion/index.php' ) {
		$rate_url = 'http://wordpress.org/support/view/plugin-reviews/occasion?rate=5#postform';
		$links[] = '<a href="' . $rate_url . '" target="_blank" title="Rate and Review this Plugin on WordPress.org">Rate this plugin</a>';
	}
	
	return $links;
}
add_filter( 'plugin_row_meta', 'occasion_add_plugin_links' , 10, 2);
?>