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
	$form = '
	<form class="navbar-form navbar-left form-inline" method="get" id="searchform" role="search" action="' . home_url( '/' ) . '">
        <div class="form-group form-group-sp">
				<input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s">
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
