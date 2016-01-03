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
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	// Enable the user with no privileges to run ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
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
	auth_user_login($_POST['username'], $_POST['password'], 'Login');
	
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
      $data = array('loggedin'=>false, 'message'=> 'Wrong username or password.', 'a' => 'error');
		echo json_encode($data);
    } else {
		wp_set_current_user($user_signon->ID); 
        echo json_encode(array('loggedin'=>true, 'message'=>__($login.' successful, redirecting...')));
    }
	
	die();
}