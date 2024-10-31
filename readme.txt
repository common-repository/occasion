=== Occasion ===
Contributors: mwtsn
Donate link: 
Tags: events, activites, calendar, recurrence, recuring, recuring events, repeating, repeating events, evenbrite
Requires at least: 3.3
Tested up to: 3.9
Stable tag: 2.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin for events (includes repeating events). Turn on or off as much meta data as you need. Also you can use the features on any post type you wish. 

== Description ==

Created by [Make Do](http://makedo.in/), this plugin gives you a custom post type for displaying your events and activities, includes repeating events right out of the box. You can turn off the post type, and just use the meta boxes on their own. 

You can also query the post types and the custom meta data, however you wish to build your own events system.

Need to add more detailed location information to your events? You can use our [Position](http://wordpress.org/plugins/position/) plugin, and associate any post type with a location.

= Occasion features =

* Recurring events (can be added to any post type)
* Custom post type for events (can be disabled)
* Event values meta box (can be added to any post type)
* Event information meta box (can be added to any post type, and fields can be customised)
* Eventbrite meta box (can be added to any post type)
* Render eventbrite box function
* Function to generate loop query arguments
* Function to render an event list
* Creates several custom images sizes for you to use in your plugin
* Shortcodes to list events
* Output event data into your RSS feeds

View the FAQ section for usage instructions.

If you are using this plugin in your project [we would love to hear about it](mailto:hello@makedo.in).

= TODO =

* Make it easier to delete recurring events

If you have any feature requests, please hit up the support section.

If you are using this plugin in your project [we would love to hear about it](mailto:hello@makedo.in).

== Installation ==

1. Backup your WordPress install
2. Upload the plugin folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. The Bootstrap 3 compatible list, rendered using the occasion_events_list_render_bootstrap() function
2. The 'events' custom post type
3. The options screen

== Frequently asked questions ==

= If I want to grab the events in my loop, what is the default custom post type name? =

It is: 'occasion_events'

= I've noticed that the events Custom Post Type has a category area, if I want to filter by this what is the taxonomy name? = 

It is also called: 'occasion_events'

= What are the names of all the meta information for the 'Event values' meta box? =

Those are:

* '_occasion_start_date'
* '_occasion_end_date'
* '_occasion_is_all_day'
* '_occasion_start_time'
* '_occasion_end_time'
* '_occasion_is_cancelled'

= What are the names of all the meta information for the 'Event information' meta box? =

Those are:

* '_occasion_url'
* '_occasion_email'
* '_occasion_sms'
* '_occasion_sms_instructions'
* '_occasion_telephone'
* '_occasion_hashtag'
* '_occasion_twitter'
* '_occasion_facebook'
* '_occasion_facebook_event'
* '_occasion_google'
* '_occasion_google_event'
* '_occasion_lanyrd'
* '_occasion_meetup'

= What are the names of all the meta information for the 'Eventbrite' meta box? =

Those are:

* '_occasion_eventbrite'
* '_occasion_eventbrite_id'
* '_occasion_eventbrite_height'

= What are the names of all the meta information for the 'Recurring event options' meta box? =

I'm glad you asked, although, these are probebly more for back-end use to be honest:

* '_occasion_is_recurring'
* '_occasion_recurance_pattern'
* '_occasion_recurance_week_pattern'
* '_occasion_recurance_week_monday'
* '_occasion_recurance_week_tuesday'
* '_occasion_recurance_week_wednesday'
* '_occasion_recurance_week_thursday'
* '_occasion_recurance_week_friday'
* '_occasion_recurance_week_saturday'
* '_occasion_recurance_week_sunday'
* '_occasion_recurance_month_pattern'
* '_occasion_recurance_month_day'
* '_occasion_recurance_month_frequency'
* '_occasion_recurance_month_day_fequency'
* '_occasion_recurance_month_day_name'
* '_occasion_recurance_month_frequency_complex'
* '_occasion_recurring_create_from'
* '_occasion_recurring_create_to'

= What functions can I use? =

The functions provided by this plugin are:

* occasion_query_arguements()
* occasion_events_list_render_bootstrap()
* occasion_get_everbrite_embed()

Although you will get much better results if you create your own templates using the custom meta data provided, the plugin also provides the following function that will generate a view:

* occasion_render_bootstrap()

All of these functions accept arguments.

= What shortcodes can I use? =

The shortcodes provided by this function are:

* [occasion_shortcode_bootstrap_list]
* [occasion_shortcode_bullet_list]

The shortcode `[occasion_shortcode_bootstrap_list]` accepts all the same arguments (and produces the same output) as the `occasion_events_list_render_bootstrap()` function.

The shortcode `[occasion_shortcode_bullet_list]` accepts the same arguments as the `occasion_query_arguements()` function.

For simple use, we recomend passing in the following two parameters into the functions:

* posts_per_page
* taxonomy_terms

For example:

`[occasion_shortcode_bootstrap_list posts_per_page="5" taxonomy_terms="event-type-slug"]`

Pagination on these shortcodes is set to false by default.

= What does the occasion_query_arguements() function do? =

This function provides arguments for you to filter the locations (or your own post types) creating a custom Loop. You can use it like so:

`get_posts( occasion_query_arguements( $args ) );`

It accepts the following arguments as an array (or you can leave the $args empty to use the defaults):

`
$defaults = array(
	'featured'					=> false, 										// [ true | false ] - Set to true to return posts that have the featured post custom meta data set to true
	'featured_post_meta_key' 	=> '_occasion_featured',						// The custom meta field that identifies the featured post, will also accept an array
	'include_in_progress'		=> true,										// [ true | false ] - Include events where the start date has passed, but the end date has not (in progress events)
	'meta_key' 					=> '_occasion_start_date',						// The meta key you wish to order the query by
	'order'						=> 'ASC',										// [ ASC | DESC ]
	'orderby'					=> 'meta_value meta_value_num', 				// [ date | menu_order | title | meta_value ] 
	'posts_per_page'			=> 10,											// Set number of posts to return, -1 will return all
	'post_status'				=> array('publish', 'occasion_recurring' ),				// Array or string, which kind of post status you wish to include in your results
	'post_type'					=> 'occasion_events',							// [ post | page | custom post type | array() ]			
	'show_only_future'			=> true,										// [ true | false ] - show only events happening, or going to happen, do not show archived events
	'show_only_future_compare'	=> '>=',										// The compare for future events
	'taxonomy_filter'			=> false,										// [ true | false ] - Set to true to filter by taxonomy
	'taxonomy_key'				=> 'occasion_category',							// The key of the taxonomy we wish to filter by
	'taxonomy_terms'			=> 'event',										// The terms (uses slug), will accept a string or array
	'use_featured_image'		=> false 										// [ true | false ] - Set to true to only use posts with a featured image
);
get_posts( occasion_query_arguements( $defaults ) );
`

= What does the occasion_events_list_render_bootstrap() function do? =

This function will render a Bootstrap 3 compatible list of locations. You can use it like so: 

`occasion_events_list_render_bootstrap( $args );`

It accepts all the same arguments as the `occasion_query_arguements()` function, as well as the following arguments as an array (or you can leave the $args empty to use the defaults):

`
$defaults = array(
	'class_dates_wrapper'			=> '',								// The wrapper arround the dates
	'class_image'					=> '',								// The class for the image
	'class_list_item_wrapper'		=> '',								// The wrapper class for each object
	'class_list_wrapper'			=> '',								// The wrapper for the entire function class
	'class_location_wrapper'		=> '',								// The wrapper for the location
	'class_media'					=> 'media',							// The media object class
	'class_media_body_wrapper'		=> 'media-body',					// The body wrapper class
	'class_media_content_wrapper'	=> '',								// The content wrapper class
	'class_media_heading'			=> 'media-heading',					// The heading class
	'class_media_image_wrapper' 	=> 'pull-left',						// The image wrapper class
	'class_pagination'				=> 'pager',							// The class of the pagination ul
	'content_source' 				=> 'excerpt', 						// [ content | excerpt ] - Choose where the content comes from.
	'date_format'					=> 'F jS, Y',						// The format of the date output
	'heading_as_link'				=> true,							// Set the heading to be a link
	'id'							=> 'occasion_list',					// If you want to have multiple renders, you will want to change the id each time
	'image_as_link'					=> true,							// Set the image to be a link
	'image_size'					=> 'square-75',						// [ thumbnail | medium | large | full | custom ] choose the size of the thumbnail (be default we use a custom size)
	'pagination_next_label'			=> 'Next »',						// The text for the 'next' pagination button
	'pagination_previous_label'		=> '« Previous',					// The text for the 'previous' pagination button
	'posts_per_page'				=> 10,								// The ammount of posts you want in the list (-1 will return all)
	'post_type'						=> 'occasion_events',				// [ post | page | custom post type | array() ]			
	'show_attribute'				=> true,							// [ true | false ] - show the block quote attribute
	'show_content'					=> true,							// [ true | false ] - show the content
	'show_dates'					=> true,							// [ true | false ] - show the dates in the list
	'show_heading'					=> true,							// [ true | false ] - show the headings
	'show_image'					=> true, 							// [ true | false ] - show images in the list
	'show_location'					=> true,							// If a related location is set, show it (this requires the plugin 'Position' to be installed)
	'show_pagination' 				=> true,							// [ true | false ] - show pagination
	'tag_dates_wrapper'				=> 'p',								// The tag that wraps the dates
	'tag_location_wrapper'			=> 'p',								// The tag for the location
	'tag_media_heading'				=> 'h4',							// The tag to be used for the heading
	'tag_media_image_wrapper'		=> 'a',								// The tag to be used for the image wrapper (if its a link, it needs to be 'a')
);
occasion_events_list_render_bootstrap( $defaults );
`

= I'm trying to use the function 'occasion_events_list_render_bootstrap()' on an archive page, but the paging doesn't work =

You can fix that by copying the following function into your functions.php:

`
function position_list_pre_get_posts( $query ) {
	if ( !is_admin() && $query->is_post_type_archive('occasion_events') && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 1 );
	}
}
add_action( 'pre_get_posts', 'position_list_pre_get_posts' );
`

= I'm trying to use the function 'occasion_events_list_render_bootstrap()' on my home page, but the friendly URL paging doesn't work =

WordPress will not let you use the friendly paging on the home page because it confuses it with the standard post paging. 

Instead of using the `occasion_events_list_render_bootstrap()` function, you should use a pre_get_posts filter to change the post type of the home page posts.

You can however still page through the list of this function, as long as you use query strings (e.g. ?page=2), but this function doesn't do that for you.

= How can I display the eventbrite embeded tickets in the front end (or what does the occasion_get_everbrite_embed() function do)? =

Use the function:

occasion_get_everbrite_embed( $post_id, $height );

You can pass an int into the $height parameter for the height of the iframe, or leave it empty to use the embed height that you can set in the eventbrite event meta box ('_occasion_eventbrite_height').

= What does the occasion_render_bootstrap() function do? =

This function will render a Bootstrap 3 compatible view of an event.  We recomend you build your own views with the meta data provided, but if you wish you can use it like so:

`occasion_render_bootstrap( $args );`

You can use it with the following arguments as an array (or you can leave the $args empty to use the defaults):

`
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
occasion_render_bootstrap( $defaults );
`

= What custom image sizes are created by this plugin? =

The image sizes are:

* 'square-75' - 75 x 75
* 'square-150' - 150 x 150
* 'square-300' - 300 x 300
* 'square-600' - 600 x 600
* 'square-1200' - 1200 x 1200

= The custom image sizes dont seem to work, help! =

The image sizes will only take effect on images you have uploaded after this plugin has been installed, however there are other plugins out there (such as [WPThumb](http://wordpress.org/plugins/wp-thumb/)) that will fix this for you.

If it still isnt working, check that you have the 'GD' module installed in your PHP environment. If you havent, you can install it like so:

`apt-get install php5-gd`

= The bootstrap render isnt working, what do I need to do? =

The plugin will only render HTML, you will need to add Bootstrap CSS and JS to your theme.

= Can I contribute? =

Sure thing, the GitHub repository is right here: (https://github.com/mwtsn/occasion)

== Changelog ==

= 2.3.2 =
* Bug fix for short code event count

= 2.3.1 =
* Bug fix meta boxes

= 2.3.0 =
* Hide meta boxes by default

= 2.2.0 =
* Add meta data to RSS feed
* Add archived post status

= 2.1.3 =
* Minor ammendments

= 2.1.2	=
* Bug fix when using a 'featured' event 

= 2.1.1	=
* Shortcode improvements

= 2.1.0	=
* Added shortcode to list out event bullets in content

= 2.0.2	/ 2.0.3 =
* Fixed orderby in query (was not sorting by start date)

= 2.0.1	=
* Fixed bug in recuring event calculations

= 2.0.0 =
Added queries and UI layer

= 1.3.1 =
* Fixed eventbrite bug

= 1.3.0 =
* Support for occuring events

= 1.2.0 =
* Eventbrite meta box support

= 1.1.1 =
* Featured image bug fix

= 1.1.0 =
* Added event information meta box

= 1.0.0 =
* Initial WordPress repository release

== Upgrade notice ==

There have been no breaking changes so far.