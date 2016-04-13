<?php
/*
Plugin Name: List Voucher
Plugin URI: www.thietkechuyennghiep.net
Description: Voucher plugin
Version: 1.1
Author: LongPham
Author URI: www.thietkechuyennghiep.net
License: Plugin comes under GPL Licence.
*/
//
//function create_table()
//{
//	global $wpdb;
//	$table_name = $wpdb->prefix ."voucher_post";
//	if($wpdb->get_var("SHOW TABLES LIKE ".$table_name) != $table_name){
//		$sql1 = "CREATE TABLE ".$table_name."(
//			id INTEGER(11) UNSIGNED AUTO_INCREMENT,
//			fullname VARCHAR(50) NOT NULL,
//			email VARCHAR(50) NOT NULL,
//			phone VARCHAR(20) NOT NULL,
//			note TEXT NULL,
//			status INTEGER(2) NOT NULL,
//			PRIMARY KEY (id)
//		)";
//		require_once ABSPATH .'wp-admin/includes/upgrade.php';
//		dbDelta($sql1);
//		add_action('TABLE VOUCHER POST', '1.1');
//	}
//}
//function delete_table(){
//	global $wpdb;
//	$table_name = $wpdb->prefix ."voucher";
//	$wpdb->query("DROP TABLE IF EXISTS $table_name");
//}
//register_activation_hook(__FILE__, "create_table");
//register_deactivation_hook(__FILE__, 'delete_table');




add_action('init', 'voucher_enqueue_script');
function voucher_enqueue_script(){
  wp_register_style( 'ajax-voucher-style',  plugins_url( '/css/style-voucher.css', __FILE__ ), array(), true );
	wp_enqueue_style('ajax-voucher-style');
  wp_enqueue_script( 'voucher_js', plugins_url( '/js/voucher.js', __FILE__ ), array('jquery'), true, 100 );
  wp_localize_script('voucher_js', 'ajax', array('url' => admin_url('admin-ajax.php')));
  wp_enqueue_script('voucher_js');
}
function random_code(){
  for ($randomNumber = mt_rand(1, 9), $i = 1; $i < 6; $i++) {
    $randomNumber .= mt_rand(0, 9);
}
  return $randomNumber;
}
function voucher_action(){
  global $wpdb;
  $result = array(
    'message' => '',
    'result' => array(),
    'status' => false,
    'post_id' => '',
    'error' => ''
  );
  
  $id = (int) $_REQUEST['code'];
  $fullname = $_REQUEST['fullname'];
  $email = $_REQUEST['email'];
  $phone = $_REQUEST['phone'];
  $note = $_REQUEST['note'];
  $total = $_REQUEST['total'];
  $code = random_code();
  if (empty($fullname)) {
    $result['error'] .= '- Họ tên không được bỏ trống.<br>'; 
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result['error'] .= '- Định dạng email không hợp lệ. <br>'; 
  }
  if (empty($phone)) {
    $result['error'] .= '- Số điện thoại được bỏ trống.<br>'; 
  }
  if(!is_numeric($total) || $total > 7){
    $result['error'] .= '- Số lượng phải nhỏ hơn 7 và là số nguyên. <br>';
  }
  $list_code = get_field('code',$id);
  $list_code = explode(',', $list_code);
  if(is_numeric($total) && $total > count($list_code)){
    $result['error'] .= '- Hiện tại chúng tôi chỉ còn '.count($list_code).' Voucher.';
  }
    
  if(empty($result[error])){
    $data = array(
      'post_id' => $id,
      'fullname' => $fullname,
      'email' =>  $email,
      'phone' =>  $phone,
      'note' =>  $note,
      'created' => time(),
      'code' => $code,
      'total' => $total,
      'status' => 0
    );
    if($data){
      $insert = $wpdb->insert('wp_voucher_post', $data, array("%s","%s","%s","%s","%s","%s","%s"));
      if($insert == true){
        // send email
        $title = 'Nhận mã kích hoạt Voucher - unimedia.vn';
        $message = 'Chào bạn '.$fullname.',<br><br> Cám ơn bạn đã đăng ký voucher của chúng tôi.<br><br>';
        $message .= 'Mã kích hoạt là:'. $code;
        if ( $message && !wp_mail($email, $title, $message) ){
          wp_die( __('Không thể gửi email.') . "<br />\n" . __('Lỗi không thể gửi email...') );
        }else{
          $result['message'] = 'Mã kích hoạt đã được gửi về email của bạn. Bạn kiểm tra email để kích hoat.';
          $result['status'] = true;
          $result['post_id'] = $id;
        }
      }
      else{
        $result['message'] = 'Gửi thông tin thất bại vui lòng kiểm tra lại.';
      }
    }
  }

  $result['result'] = $data;
  echo json_encode($result);
  die();
}
add_action('wp_ajax_voucher_action', 'voucher_action');
add_action('wp_ajax_nopriv_voucher_action', 'voucher_action');

function voucher_active_code_action(){
  global $wpdb;
  $result = array(
    'message' => '',
    'result' => array(),
    'status' => false
  );
  
  $code = $_REQUEST['code'];
  $post_id = $_REQUEST['post_id'];
  $data = array(
    'code' => '',
    'status' => 1
  );
  
  if(!empty($code)){
    //check code is valid
    
    $row = $wpdb->get_results("SELECT `post_id`, `email`,`fullname`, `phone`, `total` FROM `wp_voucher_post` WHERE `code` = $code AND `post_id` = $post_id AND `status`=0");
   
   if(!empty($row)){
    // send co to email
    $total = $row[0]->total;
    $email = $row[0]->email;
    $name = $row[0]->fullname;
    $phone = $row[0]->phone;
    
    $send_code = array();
    $list_code = get_field('code',$post_id);
    
    $list_code = explode(',', $list_code);
    if($total > count($list_code)){
      $message = 'Hiện tại chúng tôi chỉ còn: '.count($list_code).' Voucher tặng bạn.';
    }
    
    
    
    for($i = 0; $i < $total; $i++){
      if(!empty($list_code[$i])){
        array_push($send_code, $list_code[$i]);
      }
    }
    
    $arr_list_code_new = array();
    foreach ($list_code as $value){
      if(!in_array($value, $send_code)){
        array_push($arr_list_code_new, $value);
      }
    }
    if(!empty($arr_list_code_new)){
      $arr_list_code_new = implode(',', $arr_list_code_new);
    }else{
      $arr_list_code_new = '';
    }
    
    $send_code = implode(',', $send_code);
    // send mail 
    $title = 'Chúc mừng quý khách đã nhận voucher thanh công.';
    $message = '';
    
    
    
    
    
    
    $message .= '<table id="Table_01" style="background-color: #f7f8f2;" width="767" border="0" cellpadding="0" cellspacing="0">';
	$message .= '<tr>';
		$message .= '<td colspan="5" valign="top" style="line-height:0">';
			$message .= get_the_post_thumbnail($post_id, 'full');
        $message .='</td>';
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td colspan="5" valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_02" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_02.png" width="767" height="153" alt="" /></td>';
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td rowspan="3" valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_03" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_03.png" width="399" height="217" alt="" /></td>';
		$message .= '<td colspan="3" valign="top" style="line-height:0; background-color: #f7f8f2;  height: 68px; width: 222px;">';
          $message .='<p style="background-color: #f7f8f2; display: inline-block;line-height: 15px;padding: 0;margin: 0; font-size: 9px; font-weight: bold;">'. $send_code .'</p>';
			$message .= '</td>';
		$message .= '<td rowspan="5" valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_05" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_05.png" width="146" height="291" alt="" /></td>';
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td colspan="3" valign="top" style=" width: 223px;line-height:0; height: 100px; background-color: #f7f8f2;">';
            $message .= '<p style=" width: 222px;height: 20px; padding: 0; margin: 0; font-size:12px; line-height: 20px; background-color: #f7f8f2;"><strong>THÔNG TIN KHÁCH HÀNG</strong></p>';
			$message .= '<p style="width: 222px; height: 20px; padding: 0; margin: 0; font-size:12px; line-height: 20px; background-color: #f7f8f2;"><strong>Họ và tên:</strong> '.$name.'</p>';
			$message .= '<p style=" width: 222px;height: 20px; padding: 0; margin: 0; font-size:12px; line-height: 20px; background-color: #f7f8f2;"><strong>Điện thoại:</strong> '.$phone.'</p>';
			$message .= '<p style=" width: 222px;height: 40px; padding: 0; margin: 0; font-size:12px; width: 222px;background-color: #f7f8f2; line-height: 20px;overflow: hidden; text-overflow: ellipsis;"><span style="font-weight: bold;">Email:</span> '.$email.'</p>';
            $message .= '</td>';
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td colspan="3" valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_07" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_07.png" width="222" height="49" alt="" /></td>';
            
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td colspan="4" valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_08" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_08.png" width="621" height="22" alt="" /></td>';
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td colspan="2" valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_09" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_09.png" width="454" height="52" alt="" /></td>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_10" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_10.png" width="30" height="52" alt="" /></td>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img id="mail_voucher_01234_11" src="'.WP_CONTENT_URL.'/plugins/Voucher/img/mail_voucher-01234_11.png" width="137" height="52" alt="" /></td>';
	$message .= '</tr>';
	$message .= '<tr>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img src="'.WP_CONTENT_URL.'/plugins/Voucher/img/spacer.gif" width="399" height="1" alt="" /></td>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img src="'.WP_CONTENT_URL.'/plugins/Voucher/img/spacer.gif" width="55" height="1" alt="" /></td>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img src="'.WP_CONTENT_URL.'/plugins/Voucher/img/spacer.gif" width="30" height="1" alt="" /></td>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img src="'.WP_CONTENT_URL.'/plugins/Voucher/img/spacer.gif" width="137" height="1" alt="" /></td>';
		$message .= '<td valign="top" style="line-height:0">';
			$message .= '<img src="'.WP_CONTENT_URL.'/plugins/Voucher/img/spacer.gif" width="146" height="1" alt="" /></td>';
	$message .= '</tr>';
$message .= '</table>';
    
//    // get
//    $message .= "<br><br>";
    if ( $message && !wp_mail($email, $title, $message) ){
      wp_die( __('Không thể gửi email.') . "<br />\n" . __('Lỗi không thể gửi email...') );
    }else{
      // update list code post by id
        update_field( 'code', $arr_list_code_new, $post_id);
        if(empty($arr_list_code_new)){
          $status_post = array(
            'ID'           => $post_id,
            'post_status'   => 'pending',
          );
          // Update the post into the database
          wp_update_post( $status_post );
        }
        // update code for voucher
        $update = $wpdb->update( 'wp_voucher_post', $data, array('code' => $code), array('%s', '%s'));
        if($update){
          $result['message'] = 'Bạn đã đang ký nhận mã voucher thành công. Vui lòng kiểm tra email để có mã giảm giá.';
          $result['status'] = true;
        }
    }
   }else{
     $result['message'] = 'Voucher này đã hết số lượng.';
   }
  }else{
    $result['message'] = 'Mã kích hoạt không đúng.';
  }
  
  $result['result'] = $data;
  echo json_encode($result);
  die();
}
add_action('wp_ajax_voucher_active_code_action', 'voucher_active_code_action');
add_action('wp_ajax_nopriv_voucher_active_code_action', 'voucher_active_code_action');


add_action('admin_menu', 'voucher_settings');
function voucher_settings() {
    add_menu_page('List voucher', 'List voucher', 'administrator', 'voucher_vn_currency_settings', 'voucher_display_settings');
}
function voucher_display_settings () {
$html ='<div class="gencode"><h2>Tạo mã code Voucher</h2>
          <div class="control-gencode">
            <p>Mã Voucher</p>
            <p><input type="text" name="voucher-name" id="voucher-name" value="UNI" /></p>
          </div>
          <div class="control-gencode">
            <p>Số lượng code</p>
            <p><input type="text" name="voucher-number" id="voucher-number" value="" /></p>
          </div>
          
          <div class="control-gencode">
            <p><button type="button" name="submit" id="submit">Tạo mã</button></p>
          </div>
          <style>
          .result-voucher,
          .gencode{
            width: 50%;
            float: left;
          }
          #result-code{
            width: 95%;
            height: 300px;
          }
          .item{
            width: 100px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            float: left;
          }
          </style>
        </div>
        <div class="result-voucher">
        <h2>Kết quả</h2>
        <textarea id="result-code"></textarea>
        </div>
        <div id="print-list-code">
          <h2>Danh sách mã Voucher</h2>
          <div class="lst-code">
            
          </div>
        </div>
        <a id="btnPrint" style="cursor: pointer;">In</a>
                        <script type="text/javascript">
                          jQuery(document).ready(function($){
                            $("#btnPrint").on("click", function () {
                            var divContents = $("#print-list-code").html();
                            var printWindow = window.open("", "");
                            printWindow.document.write("<html><head><title>Danh sách mã Voucher</title>");
                            printWindow.document.write("</head><body >");
                            printWindow.document.write(divContents);
                            printWindow.document.write("</body></html>");
                            printWindow.document.close();
                            printWindow.print();
                            printWindow.close();
                          });
                          });
                        </script>
        ';
    echo $html;

}
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function gen_code_action(){
  global $wpdb;
  $result = array(
    'listcode' => '',
    'message' => '',
    'result' => array(),
    'status' => false,
    'post_id' => '',
    'error' => ''
  );
//  
  $code = $_REQUEST['code'];
  $quanlity = $_REQUEST['quanlity'];
    $data = array(
      'code' => $code,
      'quanlity' => $quanlity
    );
    $listCode = array();
    if(!empty($quanlity)){
      for($i=0; $i< $quanlity; $i++){
        array_push($listCode, $code.'-'.  strtoupper(generateRandomString()));
      }
    }
    $data['list'] = $listCode;
    $result['listcode'] = implode(',', $listCode);
  $result['result'] = $data;
  echo json_encode($result);
  die();
}
add_action('wp_ajax_gen_code_action', 'gen_code_action');
add_action('wp_ajax_nopriv_gen_code_action', 'gen_code_action');





function voucher_detail_action(){
  global $wpdb;
  $result = array(
    'message' => '',
    'result' => array(),
    'status' => false,
    'content' => '',
    'description' => '',
    'image' => '',
    'total' => 0,
    'id' => '',
    'error' => '',
    'sale' => ''
  );
  
  $id = (int) $_REQUEST['id'];
  if($id){
    $result['status'] = true;
    $result['id'] = $id;
    $post = get_post($id);
    query_posts( array('post__in' => array($id), 'post_type' => 'post'));
    while (have_posts()): the_post();
      $result['title'] = get_the_title();
      $result['content'] = get_the_content();
      $result['description'] = get_the_excerpt();
      $result['sale'] = get_field('sale', $id);
      $result['image'] = get_the_post_thumbnail(get_the_ID(), 'full');
   endwhile;
   $row = $wpdb->get_var("select count('post_id') from wp_voucher_post where post_id = $id");
   $result['total'] = $row;
  }else{
    $result['message'] = 'Không tải được dữ liệu. Vui lòng thử lại.';
  }
  echo json_encode($result);
  die();
}
add_action('wp_ajax_voucher_detail_action', 'voucher_detail_action');
add_action('wp_ajax_nopriv_voucher_detail_action', 'voucher_detail_action');

