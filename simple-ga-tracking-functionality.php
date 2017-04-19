<?php
/*
Plugin Name: Simple Google Analytics Tracking
Plugin URI: https://github.com/dustyndoyle/simple-google-analytics-tracking
Description: Add Google Analytics Tracking to your site easily with your Tracking ID.
Author: Dustyn Doyle
Version: 1.3
Author URI: http://www.dustyndoyle.com
*/
/*  Copyright 2017  dustyn  (email : dustyn_doyle@yahoo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$plugin_dir_path = plugin_dir_path(__FILE__);
if ( is_admin() ) {
	require_once( "{$plugin_dir_path}includes/simple-ga-tracking-input.php" );
} else {
	require_once( "{$plugin_dir_path}includes/simple-ga-tracking-output.php" );
}

// Add Settings link on plugins page
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'sgat_add_settings_link' );

function sgat_add_settings_link( $links ) {

	$links[] = '<a href="' . admin_url() . 'options-general.php?page=simple-google-analytics-tracking.php">Settings</a>';
	return $links;
}