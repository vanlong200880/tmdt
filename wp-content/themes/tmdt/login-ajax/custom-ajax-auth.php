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
        'redirecturl' => home_url().'/account/',
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
	
	global $wpdb;
	
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
		$random_password = wp_generate_password();
 
			
		// Get user data by field and data, fields are id, slug, email and login
		$user = get_user_by( $get_by, $account );
			
		$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
			
		// if  update user return true then lets send user an email containing the new password
		if( $update_user ) {
			
			$from = 'WRITE SENDER EMAIL ADDRESS HERE'; // Set whatever you want like mail@yourdomain.com
			
			if(!(isset($from) && is_email($from))) {		
				$sitename = strtolower( $_SERVER['SERVER_NAME'] );
				if ( substr( $sitename, 0, 4 ) == 'www.' ) {
					$sitename = substr( $sitename, 4 );					
				}
				$from = 'admin@'.$sitename; 
			}
			
			$to = $user->user_email;
			$subject = 'Your new password';
			$sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
			
			$message = 'Your new password is: '.$random_password;
				
			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = $sender;
				
			$mail = wp_mail( $to, $subject, $message, $headers );
			if( $mail ) 
				$success = 'Check your email address for you new password.';
			else
				$error = 'System is unable to send you mail containg your new password.';						
		} else {
			$error = 'Oops! Something went wrong while updaing your account.';
		}
	}
	
	if( ! empty( $error ) )
		echo json_encode(array('loggedin'=>false, 'message'=>__($error)));
			
	if( ! empty( $success ) )
		echo json_encode(array('loggedin'=>false, 'message'=>__($success)));
				
	die();
}