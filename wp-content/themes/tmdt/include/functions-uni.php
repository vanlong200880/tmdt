<?php
  function check_user_init(){
    global $current_user;
    $url = $_SERVER['PHP_SELF'];
    $url = explode('/', $url);
    $arr = array('wp-login.php', 'wp-admin');
    if(!empty($current_user->roles)){
      $roleName = $current_user->roles;
      if(strtolower($roleName[0]) == 'author' && (in_array($url[1], $arr) || in_array($url[2], $arr))){
        wp_redirect( home_url());
      }
    }else{
//      if (is_user_logged_in()) {
//        if(in_array($url[1], $arr) || in_array($url[2], $arr)){
//          wp_redirect( home_url());
//        }
//      }
      
    }
    
  }
  add_action('init', 'check_user_init');
        
        
function uni_special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}
add_filter('nav_menu_css_class' , 'uni_special_nav_class' , 10 , 2);

function uni_get_total_rating_by_post($post){
	global $wpdb;
	$results = $wpdb->get_results( 'SELECT SUM(rating_rating) as vote FROM wp_ratings WHERE rating_postid = '.$post, ARRAY_A );
	return $results[0]['vote'];
}

/* get list category */
function getListCategory($slug){
	$parentId = get_category_by_slug($slug);
	$args = array(
		'orderby'           => 'category_order',
		'order'             => 'DESC',
		'parent'            => $parentId->term_id,
		'taxonomy'          => 'category',
		'hide_empty'        => 0
	);
	$categories = get_categories( $args );
	$sorted_cats = array();
		foreach($categories as $cat){
			$ordr = get_field('category_order', 'category_'.$cat->term_id);
			$cat->order = $ordr;
			$sorted_cats[] = $cat;
		}
		usort($sorted_cats, function($a, $b) {
			return $a->order - $b->order;
	});
	return $sorted_cats;
}

/* custom form search */
function uni_search_form( $form ) {
	$data = getListCategory('news');
	$list = '';
	
	if($data){
		$list = '<ul id="searchAjax" class="dropdown-menu">';
		foreach ($data as $val){
			$list .= '<li><span data-key="'.$val->slug.'">'.$val->name.'</span></li>';
		}
		$list .= '</ul>';
	}
	$keyword = '';
	if(isset($_GET['keyword'])){
		$keyword = $_GET['keyword'];
	}
	$form = '
	<form class="navbar-form navbar-left form-inline" method="get" id="searchform" role="search" action="' . home_url( '/tim-kiem' ) . '">
        <div class="form-group form-group-sp">
				<input type="text" class="form-control" value="' . $keyword . '" name="keyword" id="keyword">
					'.$list.'
            <button type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" class="btn btn-default">
                <i class="fa fa-search"></i>
            </button>
		</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'uni_search_form' );

//customize the PageNavi HTML before it is output
function zen_pagination($html) {
	$out = '';
 
	//wrap a's and span's in li's
	$out = str_replace("<a","<li><a",$html);	
    $out = str_replace("<div class='wp-pagenavi'>"," ",$out);
    $out = str_replace("</div>"," ",$out);
	$out = str_replace("</a>","</a></li>",$out);
	$out = str_replace("<span","<li><span",$out);	
	$out = str_replace("</span>","</span></li>",$out);
 
	return '<ul class="pagination">'.$out.'</ul>';
}
add_filter( 'wp_pagenavi', 'zen_pagination', 10, 2 );


function geocode($address){
  $address = urlencode($address);
  $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
  $resp_json = file_get_contents($url);
  $resp = json_decode($resp_json, true);
  if($resp['status']=='OK'){
      $lati = $resp['results'][0]['geometry']['location']['lat'];
      $longi = $resp['results'][0]['geometry']['location']['lng'];
      $formatted_address = $resp['results'][0]['formatted_address'];
      if($lati && $longi && $formatted_address){
          $data_arr = array();            
          array_push(
              $data_arr, 
                  $lati, 
                  $longi, 
                  $formatted_address
              );

          return $data_arr;

      }else{
          return false;
      }

  }else{
      return false;
  }
}
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function the_excerpt_max_charlength($length = 0) {
	$excerpt = strip_tags(get_the_excerpt());
    $arrString = explode(' ', $excerpt);
    $str = array_slice($arrString, 0, $length);
    if(count($arrString) > $length){
        $str = implode( ' ', $str).'...';
    }else
    {
        $str = implode( ' ', $str);
    }
    return $str;
}

function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );


function getFacebookDetails($url){
    $rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=".urlencode($url);
    $json = json_decode(file_get_contents($rest_url),true);
    $total_comment = 0;
    if($json){
    	foreach ($json as $key => $value) {
    		$total_comment = $value['commentsbox_count'];
    	}
    }
return $total_comment;
}

function custom_loginlogo() {
echo '<style type="text/css">
h1 a {
  background-image: url('.get_bloginfo('template_directory').'/images/logo.png) !important; 
  width: 140px !important;
  height: 55px !important;
  background-size: auto auto !important;
  margin: 0px auto 0px !important;
  }
.login form{
  margin-top: 10px !important;
}
.login #backtoblog, .login #nav{
  padding: 0px 0px !important;
}
</style>';
}
add_action('login_head', 'custom_loginlogo');
function my_loginURL() {
    return home_url();
}
add_filter('login_headerurl', 'my_loginURL');

function my_loginURLtext() {
    return 'Trang chủ';
}
add_filter('login_headertitle', 'my_loginURLtext');


function my_loginredrect( $redirect_to, $request, $user ) {
	
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		$current_link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if( in_array('administrator', $user->roles) || in_array('contributor', $user->roles) || in_array('editor', $user->roles)) {
      return admin_url();
    } else {
      return $current_link;
    }
  } else {
      return $current_link;
  }
}
 
add_filter('login_redirect', 'my_loginredrect', 10, 3);



