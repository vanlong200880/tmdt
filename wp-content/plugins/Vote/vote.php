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
  wp_register_style( 'ajax-vote-style',  plugins_url( '/css/style-vote.css', __FILE__ ), array(), true );
	wp_enqueue_style('ajax-vote-style');
  wp_enqueue_script( 'voted_js', plugins_url( '/js/vote.js', __FILE__ ), array('jquery'), true, 100 );
  wp_localize_script('voted_js', 'ajax', array('url' => admin_url('admin-ajax.php')));
  wp_enqueue_script('voted_js');
}
function voted_action() {
  global $wpdb;
  $result = array(
    'message' => '',
    'result' => array()
  );
  global $current_user;
  $arr = array(1,2,3,4,5,6,7,8,9,10);
  $user_id = $current_user->ID;
  $post_id = (int)$_REQUEST['post_id'];
  $position = $_REQUEST['position'];
  $price = $_REQUEST['price'];
  $quality = $_REQUEST['quality'];
  $space = $_REQUEST['space'];
  $service = $_REQUEST['service'];
  $data = array(
    'user_id' => (int) $user_id,
    'post_id' => (int) $post_id,
    'position' => (int) $position,
    'price' => (int) $price,
    'quality' => (int) $quality,
    'service' => (int) $service,
    'space' => (int) $space
  );
  
  if(is_user_logged_in()){
    if(is_numeric($post_id) && in_array($service, $arr) && in_array($position, $arr) && in_array($price, $arr) && in_array($quality, $arr) && in_array($space, $arr)){
      // validate is voted
      $row = $wpdb->get_var("select count('id') from wp_vote_post where user_id = $user_id and post_id = $post_id");
      if(empty($row)){
        // insert db
        $wpdb->insert('wp_vote_post', $data, array("%s","%s","%s","%s","%s","%s","%s"));
        $result['message'] = 'Bạn đã gửi đánh giá thành công.';
        // get total voted
        $sum = $wpdb->get_results("SELECT COUNT(id) as total, SUM(position) as position, SUM(price) as price, SUM(service) as service, SUM(space) as space, SUM(quality) as quality FROM `wp_vote_post` WHERE post_id = $post_id");
        $data_row = array();
        foreach ($sum as $value){
            $data_row['position'] = (!empty($value->position))?round($value->position/$value->total, 2): 5;
            $data_row['price'] = (!empty($value->price))?round($value->price/$value->total, 2): 5;
            $data_row['quality'] =  (!empty($value->quality))?round($value->quality/$value->total, 2): 5;
            $data_row['service'] = (!empty($value->service))?round($value->service/$value->total, 2): 5;
            $data_row['space'] = (!empty($value->space))?round($value->space/$value->total, 2): 5;
        }
        $result['result'] = $data_row;
      }else{
        // is voted
        $result['message']= 'Bạn đã đánh giá bài viết này.';
      }
      
    }else{
      $result['message'] = 'Dữ liệu không đúng.';
      
    }
  }else{
    
  }
  echo json_encode($result);
  die();
}
add_action('wp_ajax_voted_action', 'voted_action');
add_action('wp_ajax_nopriv_voted_action', 'voted_action');

function get_vote($post_id){
  global $wpdb;
  $sum = $wpdb->get_results("SELECT COUNT(id) as total, SUM(position) as position, SUM(price) as price, SUM(service) as service, SUM(space) as space, SUM(quality) as quality FROM `wp_vote_post` WHERE post_id = $post_id");
  $data_row = array();
  if(!empty($sum)){
    foreach ($sum as $value){
      $data_row['position'] = (!empty($value->position))?round($value->position/$value->total, 2): 5;
      $data_row['price'] = (!empty($value->price))?round($value->price/$value->total, 2): 5;
      $data_row['quality'] =  (!empty($value->quality))?round($value->quality/$value->total, 2): 5;
      $data_row['service'] = (!empty($value->service))?round($value->service/$value->total, 2): 5;
      $data_row['space'] = (!empty($value->space))?round($value->space/$value->total, 2): 5;
  }
  }else{
    $data_row['position'] = 5;
    $data_row['price'] = 5;
    $data_row['quality'] =  5;
    $data_row['service'] = 5;
    $data_row['space'] = 5;
  }
  return $data_row;
}
