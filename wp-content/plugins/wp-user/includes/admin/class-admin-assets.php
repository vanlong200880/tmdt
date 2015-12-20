<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
if (!class_exists('WPUserAdminAssets')) :

    class WPUserAdminAssets {

        public function __construct() {
            add_action('init', array($this, 'admin_scripts'));
        }

        // Enqueue scripts
        public function admin_scripts() {
            if (isset($_GET['page'])) {

                if ($_GET['page'] == "wp-user-setting") {

                    wp_enqueue_script('jquery');

                    wp_enqueue_style('wpallbkbootstrapcss', WPUSER_PLUGIN_URL . "assets/css/bootstrap.min.css");
                    wp_enqueue_style('wpallbkbootstrapcss');

                    wp_enqueue_script('wpallbkbootstrapjs', WPUSER_PLUGIN_URL . "assets/js/bootstrap.min.js");
                    wp_enqueue_script('wpallbkbootstrapjs');

                    wp_enqueue_style('wpallbkadmincss', WPUSER_PLUGIN_URL . "/assets/css/wpdb_admin.css");
                    wp_enqueue_style('wpallbkadmincss');
                }
            }
        }

    }

    endif;

$obj = new WPUserAdminAssets();