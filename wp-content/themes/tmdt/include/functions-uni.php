<?php

function uni_special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}
add_filter('nav_menu_css_class' , 'uni_special_nav_class' , 10 , 2);

function category_custom_field_get_terms_orderby( $orderby, $args ){
    if($args['orderby'] == 'category_custom_field' && isset($args['category_custom_field'])) 
        return 'cv.field_value';
    return $orderby;
}

function category_custom_field_get_terms_fields( $selects, $args ){
    if($args['orderby'] == 'category_custom_field' && isset($args['category_custom_field']))
        $selects[] = 'cv.*';
    return $selects;
}

function category_custom_field_terms_clauses($pieces, $taxonomies, $args){
    global $wpdb;
    if($args['orderby'] == 'category_custom_field' && isset($args['category_custom_field']))
        $pieces['join'] .= " LEFT JOIN $wpdb->prefix" . "ccf_Value cv ON cv.term_id = tt.term_id AND cv.field_name = '".$args['category_custom_field']."'";
    return $pieces;
}    

add_filter('get_terms_orderby', 'category_custom_field_get_terms_orderby',1,2);

add_filter('get_terms_fields', 'category_custom_field_get_terms_fields',1,2);

add_filter('terms_clauses', 'category_custom_field_terms_clauses',1,3);