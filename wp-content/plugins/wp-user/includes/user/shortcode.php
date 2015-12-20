<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
ob_start();
add_shortcode('wp_user', 'wp_user');

function wp_user() {

    wp_enqueue_script('jquery');

    wp_enqueue_script('wpdbbootstrap', WPUSER_PLUGIN_URL . "assets/js/bootstrap.min.js");
    wp_enqueue_script('wpdbbootstrap');

    wp_enqueue_style('wpdbbootstrapcss', WPUSER_PLUGIN_URL . "assets/css/bootstrap.min.css");
    wp_enqueue_style('wpdbbootstrapcss');

    wp_enqueue_style('wpdbadminltecss', WPUSER_PLUGIN_URL . "assets/dist/css/AdminLTE.min.css");
    wp_enqueue_style('wpdbadminltecss');

    $return = "";
    if (!is_user_logged_in()) {
         $wp_user_disable_signup=  get_option('wp_user_disable_signup');
        $return = '<div class="">               
                <div class="tab-content">';
        include('template/defualt/login.php');
        include('template/defualt/forgot.php');       
        if(!empty($wp_user_disable_signup) && $wp_user_disable_signup==1)
        include('template/defualt/register.php');
        $return.='                 
                </div><!-- /.tab-content -->
              </div>';
    } else {
        global $current_user;
        get_currentuserinfo();
        include('template/defualt/profile.php');
    }
    return $return;
}

