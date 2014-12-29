<?php
/*
Plugin Name: Simple Google Analytics Tracking
Description: Simple plugin to add Google Analytics Tracking to your site with your Tracking ID.
Author: Dustyn Doyle
Version: 1.0
Author URI: http://www.dustyndoyle.com
*/
/*  Copyright 2014  dustyn  (email : dustyn_doyle@yahoo.com)

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

if( ! class_exists( 'Simple_Google_Analytics_Tracking' ) ){

    class Simple_Google_Analytics_Tracking {

        private static $instance = null;

        private function __construct(){

            $this->init_includes();
        }

        public static function instance(){

            if( self::$instance === null ){

                self::$instance = new Simple_Google_Analytics_Tracking();
            }

            return self::$instance;
        }

        public static function get_plugin_dir(){

            return plugin_dir_path( __FILE__ );
        }

        public static function get_plugin_url(){

            return plugin_dir_url( __FILE__ );
        }

        public static function get_css_url(){

            return self::get_plugin_url() . 'css/';
        }

        public static function get_js_url(){

            return self::get_plugin_url() . 'js/';
        }

        private function init_includes(){

            /**
             * Include all php files in the /includes directory
             *
             * https://gist.github.com/theandystratton/5924570
             */
            foreach ( glob( dirname( __FILE__ ) . '/includes/*.php' ) as $file ) { include $file; }
        }
    }
}

// instantiate the site plugin
Simple_Google_Analytics_Tracking::instance();