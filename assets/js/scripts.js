var occasion_event_input				= jQuery('#occasion_event input');
var	occasion_is_all_day					= jQuery('#occasion_is_all_day');
var	occasion_start_date					= jQuery('#occasion_start_date');
var	occasion_end_date					= jQuery('#occasion_end_date');
var	occasion_start_time					= jQuery('#occasion_start_time');
var	occasion_end_time					= jQuery('#occasion_end_time');

var occasion_event_information_input	= jQuery('#occasion_event_information input');
var occasion_sms						= jQuery('#occasion_sms');
var occasion_telephone					= jQuery('#occasion_telephone');
var occasion_hashtag					= jQuery('#occasion_hashtag');
var occasion_twitter					= jQuery('#occasion_twitter');

var occasion_eventbrite_input			= jQuery('#occasion_eventbrite input');
var occasion_eventbrite					= jQuery('#occasion_eventbrite_url');
var occasion_eventbrite_id				= jQuery('#occasion_eventbrite_id');
var occasion_eventbrite_height			= jQuery('#occasion_eventbrite_height');

var occasion_recurring_input 			= jQuery('#occasion_recurring input');
var occasion_recurring_weekly_input		= jQuery('.occasion_recurring_weekly input, .occasion_recurring_weekly select');
var occasion_recurring_monthly_input 	= jQuery('.occasion_recurring_monthly input, .occasion_recurring_monthly select');
var occasion_recurance_pattern_weekly 	= jQuery('#occasion_recurance_pattern_weekly');
var occasion_recurance_pattern_monthly 	= jQuery('#occasion_recurance_pattern_monthly');
var occasion_is_recurring				= jQuery('#occasion_is_recurring');

var occasion_recurance_week_pattern				= jQuery('#occasion_recurance_week_pattern');
var occasion_recurance_month_day				= jQuery('#occasion_recurance_month_day');
var occasion_recurance_month_frequency			= jQuery('#occasion_recurance_month_frequency');
var occasion_recurance_month_frequency_complex	= jQuery('#occasion_recurance_month_frequency_complex');
var occasion_recurring_from_to_input			= jQuery('.occasion_recurring_from_to input');

// Disabled the start and end times by default
occasion_start_time.prop('disabled', true).addClass('disabled');
occasion_end_time.prop('disabled', true).addClass('disabled');

// If the box has been checked before, enable the boxes
if( !occasion_is_all_day.prop('checked') ) 
{
	occasion_start_time.prop('disabled', false).removeClass('disabled');
	occasion_end_time.prop('disabled', false).removeClass('disabled');
}

// Disable all the occurance controls, unless the event is recurring and the correct pattern is selected
occasion_recurring_weekly_input.prop('disabled', true).addClass('disabled');
occasion_recurring_monthly_input.prop('disabled', true).addClass('disabled');
occasion_recurance_pattern_weekly.prop('disabled', true).addClass('disabled');
occasion_recurance_pattern_monthly.prop('disabled', true).addClass('disabled');
occasion_recurring_from_to_input.prop('disabled', true).addClass('disabled');

if( occasion_is_recurring.prop('checked') && !occasion_is_recurring.prop('disabled') )
{
	occasion_recurance_pattern_weekly.prop('disabled', false).removeClass('disabled');
	occasion_recurance_pattern_monthly.prop('disabled', false).removeClass('disabled');
	occasion_recurring_from_to_input.prop('disabled', false).removeClass('disabled');

	if( occasion_recurance_pattern_weekly.prop('checked') )
	{
		occasion_recurring_weekly_input.prop('disabled', false).removeClass('disabled');
	}

	if( occasion_recurance_pattern_monthly.prop('checked') )
	{
		occasion_recurring_monthly_input.prop('disabled', false).removeClass('disabled');
	}
}

/**
 * 
 * When input boxes have the focus shifted (blured) do calculations
 * 
 */
occasion_event_input.bind('blur', function(){

	if( occasion_start_date.val() != '' && occasion_end_date.val() == '' )
	{
		occasion_end_date.val( occasion_start_date.val() );
	}
	if( occasion_start_date.val() != '' && occasion_end_date.val() != '' )
	{
		if (occasion_end_date.val() < occasion_start_date.val() )
		{
			occasion_end_date.val( occasion_start_date.val() );
		}
	}

	if( occasion_start_time.val() != '' && occasion_end_time.val() == '' )
	{
		occasion_end_time.val( occasion_start_time.val() );
	}

});

/**
 * 
 * When the occasion_is_all_day checkbox is clicked
 * 
 */
occasion_is_all_day.click(function(){

	// Calculate the discounts
	if( this.checked )
	{
		occasion_start_time.prop('disabled', true).addClass('disabled');
		occasion_end_time.prop('disabled', true).addClass('disabled');
		occasion_start_time.val( '' );
		occasion_end_time.val( '' );
	}
	else
	{
		occasion_start_time.prop('disabled', false).removeClass('disabled');
		occasion_end_time.prop('disabled', false).removeClass('disabled');
	}

});

occasion_event_information_input.bind('blur', function(){

	if( occasion_sms.length && occasion_sms.val() != '' )
	{
		occasion_sms.val( jQuery.trim( occasion_sms.val().replace(/[^0-9\s]/g,'') ).replace( /\s\s+/g, ' ' ) );
	}

	if( occasion_telephone.length && occasion_telephone.val() != '' )
	{
		occasion_telephone.val( jQuery.trim( occasion_telephone.val().replace(/[^0-9\s]/g,'') ).replace( /\s\s+/g, ' ' ) );
	}

	if( occasion_hashtag.length && occasion_hashtag.val() != '' )
	{
		occasion_hashtag.val( occasion_hashtag.val().toUpperCase().replace(/[^0-9A-Z]/g,'') );
	}

	if( occasion_twitter.length && occasion_twitter.val() != '' )
	{
		occasion_twitter.val( occasion_twitter.val().replace(/[^0-9a-zA-Z_]/g,'') );
	}

});

occasion_eventbrite_input.bind('blur', function(){

	if( occasion_eventbrite.val() != '' && occasion_eventbrite_id.val() == '' )
	{
		id 		 = occasion_eventbrite.val();
		position = id.indexOf( 'tickets-' ) + 8;
		if( position > -1 )
		{
			id 		 = id.substring( position );
			position = id.indexOf( '?' );

			if( position > -1 )
			{
				id 	= id.substring( 0, position );
			}

			id = id.replace(/[^0-9]/g,'')
			occasion_eventbrite_id.val( id );
		}
	}

	if( occasion_eventbrite_id.val() != '' )
	{
		occasion_eventbrite_id.val( occasion_eventbrite_id.val().replace(/[^0-9]/g,'') );
	}

	if( occasion_eventbrite_height.val() != '' )
	{
		occasion_eventbrite_height.val( occasion_eventbrite_height.val().replace(/[^0-9]/g,'') );
	}

});

occasion_recurring_input.bind('click', function(){

	if( occasion_is_recurring.prop('checked') )
	{
		occasion_recurance_pattern_weekly.prop('disabled', false).removeClass('disabled');
		occasion_recurance_pattern_monthly.prop('disabled', false).removeClass('disabled');

		if( occasion_recurance_pattern_weekly.prop('checked') )
		{
			occasion_recurring_weekly_input.prop('disabled', false).removeClass('disabled');
			occasion_recurring_from_to_input.prop('disabled', false).removeClass('disabled');
		}
		else
		{
			occasion_recurring_weekly_input.prop('disabled', true).addClass('disabled');
		}

		if( occasion_recurance_pattern_monthly.prop('checked') )
		{
			occasion_recurring_monthly_input.prop('disabled', false).removeClass('disabled');
			occasion_recurring_from_to_input.prop('disabled', false).removeClass('disabled');
		}
		else
		{
			occasion_recurring_monthly_input.prop('disabled', true).addClass('disabled');
		}
	}
	else
	{
		occasion_recurring_weekly_input.prop('disabled', true).addClass('disabled');
		occasion_recurring_monthly_input.prop('disabled', true).addClass('disabled');
		occasion_recurance_pattern_weekly.prop('disabled', true).addClass('disabled');
		occasion_recurance_pattern_monthly.prop('disabled', true).addClass('disabled');
		occasion_recurring_from_to_input.prop('disabled', true).addClass('disabled');
	}

});

occasion_recurring_input.bind('blur', function(){

	if( !jQuery.isNumeric( occasion_recurance_week_pattern.val() ) || occasion_recurance_week_pattern.val() < 1)
	{
		occasion_recurance_week_pattern.val(1);
	}
	else if( occasion_recurance_week_pattern.val() > 52 )
	{
		occasion_recurance_week_pattern.val(52);
	}

	if( !jQuery.isNumeric( occasion_recurance_month_day.val() ) || occasion_recurance_month_day.val() < 1)
	{
		occasion_recurance_month_day.val(1);
	}
	else if( occasion_recurance_month_day.val() > 31 )
	{
		occasion_recurance_month_day.val(31);
	}

	if( !jQuery.isNumeric( occasion_recurance_month_frequency.val() ) || occasion_recurance_month_frequency.val() < 1)
	{
		occasion_recurance_month_frequency.val(1);
	}
	else if( occasion_recurance_month_frequency.val() > 12 )
	{
		occasion_recurance_month_frequency.val(12);
	}

	if( !jQuery.isNumeric( occasion_recurance_month_frequency_complex.val() ) || occasion_recurance_month_frequency_complex.val() < 1)
	{
		occasion_recurance_month_frequency_complex.val(1);
	}
	else if( occasion_recurance_month_frequency_complex.val() > 12 )
	{
		occasion_recurance_month_frequency_complex.val(12);
	}

});