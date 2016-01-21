<?php
/*
Plugin Name: Bình chọn
Plugin URI: www.thietkechuyennghiep.net
Description: Vote ajax plugin
Version: 1.0
Author: LongPham
Author URI: www.thietkechuyennghiep.net
License: Plugin comes under GPL Licence.
*/

function create_table()
{
	global $wpdb;
	$table_name = $wpdb->prefix ."vote_post";
	if($wpdb->get_var("SHOW TABLES LIKE ".$table_name) != $table_name){
		$sql = "CREATE TABLE ".$table_name."(
			id INTEGER(11) UNSIGNED AUTO_INCREMENT,
			user_id INTEGER(2) NOT NULL,
			post_id INTEGER(2) NOT NULL,
			position INTEGER(2) NOT NULL,
			price INTEGER(2) NOT NULL,
			quality INTEGER(2) NOT NULL,
			service INTEGER(2) NOT NULL,
			space INTEGER(2) NOT NULL,
			PRIMARY KEY (id)
		)";
		require_once ABSPATH .'wp-admin/includes/upgrade.php';
		dbDelta($sql);
		add_action('TABLE VOTE POST', '1.0');
	}
}
function delete_table(){
	global $wpdb;
	$table_name = $wpdb->prefix ."vote_post";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
}
register_activation_hook(__FILE__, "create_table");
register_deactivation_hook(__FILE__, 'delete_table');




add_action('init', 'voted_enqueue_script');
function voted_enqueue_script(){
  wp_enqueue_script( 'voted_js', plugins_url( '/js/vote.js', __FILE__ ), array('jquery'), true );
//    wp_register_script('dvd_js', self::get_url( 'js/vote.js' ), array('jquery'), null, false);
    wp_localize_script('voted_js', 'ajax', array('url' => admin_url('admin-ajax.php')));
    wp_enqueue_script('voted_js');
}
function voted_action() {
//  var_dump('sdfsdf');
//    echo 'dgdfgdgdgdfg';
//    $result = array('b' => 'sdf');
//    $result = json_encode($result);
//    echo $result;
  $data = $_REQUEST['post_id'];
    echo json_encode($data);
    die();
}
add_action('wp_ajax_voted_action', 'voted_action');
add_action('wp_ajax_nopriv_voted_action', 'voted_action');
