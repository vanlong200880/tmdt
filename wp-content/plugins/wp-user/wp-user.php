<?php

/*
  Plugin Name: WP User
  Plugin URI: http://www.wpseeds.com/wp-user/
  Description: WP User offer beautiful front-end user profiles, login and registration for WordPress.
  Author: Prashant Walke
  Version: 1.0
  Author URI: https://walkeprashant.wordpress.com/about-me/
  Text Domain: wpuser
  Domain Path: /lang
  License: GPLv2
 */

/*
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('WPUser')) :

    final class WPUser {

        public $version = '1.0';
        public $WPUSERprefix = "wpuser";
        protected static $_instance = null;
        public $query = null;

        public static function instance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __clone() {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0');
        }

        public function __construct() {
            // Define constants
            $this->define_constants();
            register_activation_hook(__FILE__, array($this, 'installation'));
            add_action('plugins_loaded', array($this, 'load_textdomain'));
            $this->installation();
            // Include required files		
            $this->includes();
        }

        private function define_constants() {
            define('WPUSER_PLUGIN_FILE', __FILE__);
            define('WPUSER_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('WPUSER_PLUGIN_DIR', plugin_dir_path(__FILE__));

            define('WPUSER_VERSION', $this->version);
            define('WPUSER_PREFIX', $this->WPUSERprefix);
            define('WPUSER_TYPE', 'FREE');            
        }

        function includes() {
            include_once( 'includes/admin/class-admin-assets.php' );
            include_once( 'includes/admin/class-admin-settings.php' );
            include_once( 'includes/user/shortcode.php' );
        }

        function installation() {
             include('includes/installation.php');
        }

        function load_textdomain() {
            load_plugin_textdomain('wpuser', plugin_dir_path(__FILE__) . '/lang', 'wp-user/lang');
        }

    }

    endif;

function WPUserFunction() {
    return WPUser::instance();
}

$GLOBALS['WPUser'] = WPUserFunction();
?>