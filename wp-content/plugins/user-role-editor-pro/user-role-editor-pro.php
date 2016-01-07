<?php
/*
Plugin Name: User Role Editor Pro
Plugin URI: http://role-editor.com
Description: Change/add/delete WordPress user roles and capabilities.
Version: 4.14.4
Author: Vladimir Garagulya
Author URI: http://role-editor.com
Text Domain: ure
Domain Path: /lang/
*/

/*
Copyright 2010-2013  Vladimir Garagulya  (email: vladimir@shinephp.com)
*/

if (!function_exists("get_option")) {
  header('HTTP/1.0 403 Forbidden');
  die;  // Silence is golden, direct call is prohibited
}

if (defined('URE_PLUGIN_URL')) {
   wp_die('It seems that other version of User Role Editor is active. Please deactivate it before use this version');
}
    
define('URE_VERSION', '4.14.4');
define('URE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('URE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('URE_PLUGIN_FILE', basename(__FILE__));
define('URE_PLUGIN_FULL_PATH', __FILE__);
if (!class_exists('Garvs_WP_Lib')) {
  require_once(URE_PLUGIN_DIR.'includes/class-garvs-wp-lib.php');
}
require_once( URE_PLUGIN_DIR .'includes/class-ure-lib.php');
require_once( URE_PLUGIN_DIR .'includes/pro/class-ure-lib-pro.php');

// check PHP version
$ure_required_php_version = '5.2.4';
$exit_msg = sprintf( 'User Role Editor requires PHP %s or newer.', $ure_required_php_version ) . 
                         '<a href="http://wordpress.org/about/requirements/"> ' . 'Please update!' . '</a>';
URE_Lib_Pro::check_version( PHP_VERSION, $ure_required_php_version, $exit_msg, __FILE__ );

// check WP version
$ure_required_wp_version = '3.5';
$exit_msg = sprintf( 'User Role Editor requires WordPress %s or newer.', $ure_required_wp_version ) . 
                        '<a href="http://codex.wordpress.org/Upgrading_WordPress"> ' . 'Please update!' . '</a>';
URE_Lib_Pro::check_version(get_bloginfo('version'), $ure_required_wp_version, $exit_msg, __FILE__ );

require_once(URE_PLUGIN_DIR .'includes/define-constants.php');
require_once(URE_PLUGIN_DIR .'includes/misc-support-stuff.php');
require_once(URE_PLUGIN_DIR .'includes/class-ure-screen-help.php');
require_once(URE_PLUGIN_DIR .'includes/pro/class-ure-screen-help-pro.php');
require_once( URE_PLUGIN_DIR . 'includes/class-user-role-editor.php');
require_once( URE_PLUGIN_DIR . 'includes/pro/class-user-role-editor-pro.php');
require_once( URE_PLUGIN_DIR . 'includes/pro/class-export-import.php');

$ure_lib = new URE_Lib_Pro('user_role_editor');
$user_role_editor = new User_Role_Editor_Pro($ure_lib);
$GLOBALS['user_role_editor'] = $user_role_editor;

if (is_admin()) {
    require_once( URE_PLUGIN_DIR .'includes/pro/plugin-update-checker.php');

    $ure_update_checker = new PluginUpdateChecker(
      'https://www.role-editor.com/update?action=get_metadata&slug=user-role-editor-pro',
      __FILE__
    );

    //Add the license key to query arguments.
    $ure_update_checker->addQueryArgFilter(array($user_role_editor, 'filter_update_checks'));
}
