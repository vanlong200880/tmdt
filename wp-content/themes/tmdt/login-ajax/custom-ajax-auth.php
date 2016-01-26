<?php
function ajax_auth_init(){	
//	wp_register_style( 'ajax-auth-style', get_template_directory_uri() . '/login-ajax/ajax-auth-style.css' );
//	wp_enqueue_style('ajax-auth-style');
	
	wp_register_script('validate-script', get_template_directory_uri() . '/login-ajax/jquery.validate.js', array('jquery') , 20130402 ); 
    wp_enqueue_script('validate-script');

    wp_register_script('ajax-auth-script', get_template_directory_uri() . '/login-ajax/ajax-auth-script.js', array('jquery'), 20130402 ); 
    wp_enqueue_script('ajax-auth-script');

    wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
        'loadingmessage' => __('')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	// Enable the user with no privileges to run ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
  // Enable the user with no privileges to run ajax_forgotPassword() in AJAX
  add_action( 'wp_ajax_nopriv_ajaxforgotpassword', 'ajax_forgotPassword' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_auth_init');
}
  
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
  	// Call auth_user_login
	auth_user_login($_POST['username'], $_POST['password'], '');
	
    die();
}

function ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );
		
    // Nonce is checked, get the POST data and sign user on
    if(sanitize_text_field($_POST['password']) != sanitize_text_field($_POST['password2'])){
      echo json_encode(array('loggedin'=>false, 'message'=>__('Nhập lại mật khẩu không đúng.')));
    }else{
      $info = array();
      $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
      $info['user_pass'] = sanitize_text_field($_POST['password']);
      $info['user_email'] = sanitize_email( $_POST['email']);
      // Register the user
      $user_register = wp_insert_user( $info );
      if ( is_wp_error($user_register) ){	
        $error  = $user_register->get_error_codes()	;

        if(in_array('empty_user_login', $error))
          echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
        elseif(in_array('existing_user_login',$error))
          echo json_encode(array('loggedin'=>false, 'message'=>__('Tên đăng nhập đã được sử dụng.')));
        elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message'=>__('EMail đã được đăng ký.')));
      } else {
        auth_user_login($info['nickname'], $info['user_pass'], 'Registration');       
      }
    }
    die();
}

function auth_user_login($user_login, $password, $login)
{
	$info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;
    
	$user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
      $data = array('loggedin'=>false, 'message'=> 'Tên đăng nhập or mật khẩu không đúng.');
		echo json_encode($data);
    } else {
        wp_set_current_user($user_signon->ID);
        echo json_encode(array('loggedin'=>true, 'message'=>__($login.'')));
    }
	
	die();
}

function ajax_forgotPassword(){
	 
	// First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-forgot-nonce', 'security' );
	
	 global $wpdb, $wp_hasher;
	
	$account = $_POST['user_login'];
	
	if( empty( $account ) ) {
		$error = 'Nhập username hoặc Email.';
	} else {
		if(is_email( $account )) {
			if( email_exists($account) ) 
				$get_by = 'email';
			else	
				$error = 'Tên đăng nhập hoặc Email chưa được đăng ký.';			
		}
		else if (validate_username( $account )) {
			if( username_exists($account) ) 
				$get_by = 'login';
			else	
				$error = 'Tên đăng nhập hoặc Email chưa được đăng ký.';				
		}
		else
			$error = 'Tên đăng nhập hoặc Email không đúng.';		
	}	
	
	if(empty ($error)) {
		// lets generate our new password
		//$random_password = wp_generate_password( 12, false );
//		$random_password = wp_generate_password();
// 
//			
//		// Get user data by field and data, fields are id, slug, email and login
//		$user = get_user_by( $get_by, $account );
//			
//		$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
//			
//		// if  update user return true then lets send user an email containing the new password
//		if( $update_user ) {
//			
//			$from = 'WRITE SENDER EMAIL ADDRESS HERE'; // Set whatever you want like mail@yourdomain.com
//			
//			if(!(isset($from) && is_email($from))) {		
//				$sitename = strtolower( $_SERVER['SERVER_NAME'] );
//				if ( substr( $sitename, 0, 4 ) == 'www.' ) {
//					$sitename = substr( $sitename, 4 );					
//				}
//				$from = 'admin@'.$sitename;
//			}
//			
//			$to = $user->user_email;
//			$subject = 'Mật khẩu mới';
//			$sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
//			
//			$message = 'Mật khẩu mới của bạn là: '.$random_password;
//				
//			$headers[] = 'MIME-Version: 1.0' . "\r\n";
//			$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//			$headers[] = "X-Mailer: PHP \r\n";
//			$headers[] = $sender;
//				
//			$mail = wp_mail( $to, $subject, $message, $headers );
//			if( $mail ) 
//				$success = 'Bạn kiểm tra email. Chúng tôi đã gửi mật khẩu mới về email của bạn.';
//			else
//				$error = 'Hệ thống không thể gửi mật khẩu mới về email của bạn.';						
//		} else {
//			$error = 'Lỗi không thể gửi mail.';
//		}
    //change_retrieve_password($account);
    $user_login = $account;
    $user_login = sanitize_text_field($user_login);
    if ( empty( $user_login) ) {
        return false;
    } else if ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( $user_login ) );
        if ( empty( $user_data ) )
           return false;
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    do_action('lostpassword_post');
    if ( !$user_data ) return false;
    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);
    $allow = apply_filters('allow_password_reset', true, $user_data->ID);
    if ( ! $allow )
        return false;
    else if ( is_wp_error($allow) )
        return false;
    $key = wp_generate_password( 20, false );
    do_action( 'retrieve_password_key', $user_login, $key );

    if ( empty( $wp_hasher ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
    }
    $hashed = $wp_hasher->HashPassword( $key );    
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => time().":".$hashed ), array( 'user_login' => $user_login ) );
    $message = __('Chúng tôi đã nhận được yêu cầu cấp lại mật khẩu của bạn:') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('Nếu đây không phải là email của bạn. Xin vui lòng bỏ qua email này. Xin cảm ơn.') . "\r\n\r\n";
    $message .= __('Bạn hãy bấm vào link bên dưới để đổi mật khẩu:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    if ( is_multisite() )
        $blogname = $GLOBALS['current_site']->site_name;
    else
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] đổi mật khẩu'), $blogname );

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ( $message && !wp_mail($user_email, $title, $message) )
        wp_die( __('Không thể gửi email.') . "<br />\n" . __('Lỗi không thể gửi email...') );

    $success = 'Link đổi mật khẩu đã được gửi về email của bạn. Vui lòng kiểm tra email.';
	}
	
	if( ! empty( $error ) )
		echo json_encode(array('loggedin'=>false, 'message'=>__($error)));
			
	if( ! empty( $success ) )
		echo json_encode(array('loggedin'=>false, 'message'=>__($success)));
				
	die();
}

function change_retrieve_password($user_login){
    global $wpdb, $wp_hasher;
    $user_login = sanitize_text_field($user_login);
    if ( empty( $user_login) ) {
        return false;
    } else if ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( $user_login ) );
        if ( empty( $user_data ) )
           return false;
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    do_action('lostpassword_post');
    if ( !$user_data ) return false;
    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);
    $allow = apply_filters('allow_password_reset', true, $user_data->ID);
    if ( ! $allow )
        return false;
    else if ( is_wp_error($allow) )
        return false;
    $key = wp_generate_password( 20, false );
    do_action( 'retrieve_password_key', $user_login, $key );

    if ( empty( $wp_hasher ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
    }
    $hashed = $wp_hasher->HashPassword( $key );    
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => time().":".$hashed ), array( 'user_login' => $user_login ) );
    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    if ( is_multisite() )
        $blogname = $GLOBALS['current_site']->site_name;
    else
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] Password Reset'), $blogname );

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ( $message && !wp_mail($user_email, $title, $message) )
        wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );

    echo '<p>Link for password reset has been emailed to you. Please check your email.</p>';
}