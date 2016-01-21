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