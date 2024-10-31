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
function occasion_eventbrite_meta_box() {

	// Only add the box to the selected post types
	$screens 		= array();
	$post_types 	= get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_occasion_show_eventbrite_on_' . $post_type ) === 'show' )
		{
			array_push( $screens, $post_type );
		}
	}

	foreach ( $screens as $screen ) 
	{
		add_meta_box(
			'occasion_eventbrite',
			'Eventbrite',
			'occasion_eventbrite_render_meta_box',
			$screen
		);
	}

}
add_action( 'add_meta_boxes', 'occasion_eventbrite_meta_box' );



/**
 * 
 * @since  		1.2.0
 * 
 * Render the eventbrite meta box
 * 
 */
function occasion_eventbrite_render_meta_box( $post ) {

	$occasion_eventbrite 		= get_post_meta( $post->ID, '_occasion_eventbrite', true );
	$occasion_eventbrite_id 	= get_post_meta( $post->ID, '_occasion_eventbrite_id', true );
	$occasion_eventbrite_height	= get_post_meta( $post->ID, '_occasion_eventbrite_height', true );

	?>
		<div class="occasion_eventbrite cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_eventbrite_url">Eventbrite</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="text" id="occasion_eventbrite_url" name="occasion_eventbrite_url" value="<?php echo $occasion_eventbrite; ?>"/>
					</div>
				</div>
			</p>
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_eventbrite_id">Eventbrite ID</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="text" id="occasion_eventbrite_id" name="occasion_eventbrite_id" value="<?php echo $occasion_eventbrite_id; ?>"/>
					</div>
				</div>
			</p>
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="occasion_eventbrite_height">Embed height</label>
						</strong>
					</div>
					<div class="input__container">
						<div class="input__wrapper right px">
							<input type="text" id="occasion_eventbrite_height" name="occasion_eventbrite_height" value="<?php echo $occasion_eventbrite_height; ?>"/><span class="help-inline at">px</span>
						</div>
					</div>
				</div>
			</p>
		</div> 

	<?php

	if( !empty( $occasion_eventbrite_id ) )
	{
		?>
		
			<?php echo '</div><hr/><div class="inside">'; ?>

			<div class="occasion_eventbrite cf">	
				
				<p>Your eventbrite tickets will display as follows:</p>
				
				<?php echo occasion_get_everbrite_embed( $post->ID ); ?>

			</div>

		<?php
	}

	wp_nonce_field( 'submit_occasion_eventbrite_values', 'occasion_eventbrite_nonce' ); 
}


/**
 * 
 * @since  		1.2.0
 * 
 * Handle the eventbrite meta box post data
 * 
 */
function occasion_eventbrite_handle_post_data( $post_id )
{
	$nonce_key							= 'occasion_eventbrite_nonce';
	$nonce_action						= 'submit_occasion_eventbrite_values';

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

	$occasion_eventbrite 		= isset( $_POST['occasion_eventbrite_url'] ) 	? esc_url_raw( $_POST['occasion_eventbrite_url'] ) 		: null;
	$occasion_eventbrite_id 	= isset( $_POST['occasion_eventbrite_id'] ) 	? $_POST['occasion_eventbrite_id']						: null;
	$occasion_eventbrite_height = isset( $_POST['occasion_eventbrite_height'] ) ? $_POST['occasion_eventbrite_height']					: null;

	if( !empty( $occasion_eventbrite_id ) )
	{
		$occasion_eventbrite_id = preg_replace( '/[^0-9]/', '', $occasion_eventbrite_id );
	}

	if( !empty( $occasion_eventbrite_height ) )
	{
		$occasion_eventbrite_height = preg_replace( '/[^0-9]/', '', $occasion_eventbrite_height );
	}

	update_post_meta( $post_id, '_occasion_eventbrite', 		$occasion_eventbrite );
	update_post_meta( $post_id, '_occasion_eventbrite_id', 		$occasion_eventbrite_id );
	update_post_meta( $post_id, '_occasion_eventbrite_height', 	$occasion_eventbrite_height );

}
add_action( 'save_post', 'occasion_eventbrite_handle_post_data' );
?>