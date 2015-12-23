<?php

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
