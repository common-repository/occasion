<?php
/**
 * @package Occasion
 * @version 2.3.2
 */

/*
Plugin Name:  Occasion
Plugin URI:   http://makedo.in/products/
Description:  A plugin for events (includes repeating events). Turn on or off as much meta data as you need. Also you can use the features on any post type you wish. 
Author:       Make Do
Version:      2.3.2
Author URI:   http://makedo.in
Licence:      GPLv2 or later
License URI:  http://www.gnu.org/licenses/gpl-2.0.html


/////////  VERSION HISTORY

1.0.0			First development version
1.1.0			Events information meta box added
1.1.1			Featured image bug fix
1.2.0			Eventbrite embed support
1.3.0			Recurring events
1.3.1			Fixed eventbrite bug
2.0.0			Added queries and UI layer
2.0.1			Fixed bug in recuring event calculations
2.0.2 / 2.0.3	Fixed orderby in query (was not sorting by start date)
2.1.0			Added shortcode to list out event bullets in content
2.1.1 			Shortcode improvements
2.1.2 			Bug fix when using a 'featured' event
2.1.3 			Minor ammendments
2.2.0 			Add meta data to RSS feed / Added archived post status
2.3.0 			Hide meta boxes by default
2.3.1 			Bug fix meta boxes
2.3.2 			Bug fix for short code

/////////  CURRENT FUNCTIONALITY

1  - Admin options screen
2  - Enqueue scripts
3  - Create custom post type
4  - Create occasion category custom taxonomy
5  - Event settings custom meta box
6  - Event information meta box
7  - Eventbrite meta box
8  - Eventbrite render function
9  - Post status for recurring events
10 - Add column filters
11 - Recurring meta box
12 - Query arguments
13 - Render upcoming events list
14 - Event type taxonomy
15 - Render event view
16 - Shortcode to display event list
17 - Shortcode to display event list as bullets
18 - Add custom meta to RSS feed
19 - Add archived post status

*/

// 1  - Admin options screen
require_once 'admin-options.php';

// 2  - Enqueue scripts
require_once 'admin-scripts.php';

// 3  - Create custom post type
require_once 'admin-post-type-occasion-events.php';

// 4  - Create occasion category custom taxonomy
require_once 'admin-taxonomy-occasion-category.php';

// 5  - Cost custom meta box
require_once 'admin-meta-box-event-values.php';

// 6  - Event information meta box
require_once 'admin-meta-box-event-information.php';

// 7  - Eventbrite meta box
require_once 'admin-meta-box-eventbrite.php';

// 8  - Eventbrite render function
require_once 'ui-render-eventbrite.php';

// 9  - Post status for recurring events
require_once 'admin-post-status-occasion-recurring.php';

// 10 - Post status for recurring events
require_once 'admin-column-filters.php';

// 11 - Recurring meta box
require_once 'admin-meta-box-recurring.php';

// 12 - Query arguments
require_once 'ui-query-arguments-occasion.php';

// 13 - Render upcoming events list
require_once 'ui-render-event-list.php';
 
// 14 - Event type taxonomy
require_once 'admin-taxonomy-occasion-category.php';

// 15 - Render event view
require_once 'ui-render-event.php';

// 16 - Shortcode to display event list
require_once 'ui-shortcode-render-event-list.php';

// 17 - Shortcode to display event list as bullets
require_once 'ui-shortcode-render-event-list-bullets.php';

// 18 - Add custom meta to RSS feed
require_once 'helper-add-rss-meta.php';

// 19 - Add archived post status
require_once 'admin-post-status-occasion-archived.php';
?>