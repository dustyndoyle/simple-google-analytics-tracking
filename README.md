Simple Google Analytics Tracking
================================

Easily add your Google Analytics Tracking ID to your WordPress site with Simple Google Analytics Tracking.

To add your Tracking ID install this plugin, then under the Settings menu there will be a new option called "Google Analytics". Click on "Google Analytics", then add your Tracking ID to the input box and click "Save Tracking ID".

Simple Google Analytics Tracking does NOT track logged in editors and administrators to prevent extra page views from people who work on your site.

Filters
------------

You can also add your Google Analytics Tracking ID programmatically through the filter `ga_tracking_id`.

Example Usage:
```
apply_filter( 'ga_tracking_id', 'dld_custom_ga_tracking_id' );
function dld_custom_ga_tracking_id( tracking_id ) {
  tracking_id = 'UA-123456-7';
  return tracking_id;
}
```
Contributors
-------------
[@dustyndoyle](https://github.com/dustyndoyle),
[@salcode](https://github.com/salcode)
