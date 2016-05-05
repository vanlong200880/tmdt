<?php
	wp_reset_postdata();
  $item = 4;
	$row = '';
	$col = '';
  if(wpmd_is_tablet()){
//    $item = 6;
		$row = 'row';
		$col = 'col-sm-4';
  }
	$char = 25;
	if(wpmd_is_phone()){
		$char = 15;
		$row = 'row';
		$col = 'col-sm-12';
	}
  $slug = 'quang-cao';
  $top_category = 'advertisement_top';
  $category = get_queried_object();
  if(!empty($category->slug)){
    $slug = $category->slug;
    if($slug ==='du-lich'){
      $slug = 'du-lich-quang-cao';
      $top_category = 'top_category';
    }
    
    if($slug ==='xe-cong-nghe'){
      $slug = 'xe-cong-nghe-quang-cao';
      $top_category = 'top_category';
    }
    if($slug ==='thoi-trang-suc-khoe'){
      $slug = 'thoi-trang-suc-khoe-quang-cao';
      $top_category = 'top_category';
    }
    if($slug ==='nguon-dia-oc' ){
      $slug = 'nguon-dia-oc-quang-cao';
      $top_category = 'top_category';
    }
    if($slug ==='dien-gia-dung'){
      $slug = 'dien-gia-dung-quang-cao';
      $top_category = 'top_category';
    }
    if($slug ==='am-thuc-tiec'){
      $slug = 'am-thuc-tiec-quang-cao';
      $top_category = 'top_category';
    }
    if($slug ==='4-mua-khuyen-mai'){
      $slug = '4-mua-khuyen-mai-quang-cao';
      $top_category = 'top_category';
    }
    
    
    if($slug ==='xe-cong-nghe-moi'){
      $slug = 'xe-cong-nghe-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='thoi-trang-suc-khoe-moi'){
      $slug = 'thoi-trang-suc-khoe-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='nguon-dia-oc-moi') {
      $slug = 'nguon-dia-oc-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='dien-gia-dung-moi') {
      $slug = 'dien-gia-dung-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    
    elseif($slug ==='am-thuc-tiec-moi') {
      $slug = 'am-thuc-tiec-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='4-mua-khuyen-mai-moi') {
      $slug = '4-mua-khuyen-mai-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug =='khuyen-mai'){
      $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
      $top_category = 'quang_cao_top_3_trang_khuyen_mai';
    }
    elseif($slug =='tap-chi-moi'){
      $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug =='copon'){
      $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
      $top_category = 'quang_cao_top_3_trang_coupon';
    }else{
      $top_category = 'top_category';
    }
  }
  if(is_page('page-tap-chi-online')){
    $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
    $top_category = 'quang_cao_top_3_trang_tạp_chi';
  }
//  var_dump($slug, $top_category);
	$args = array (
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'menu_order',
			'post_type'      => 'post',
			'category_name'  => $slug,
			'meta_query'     => array(
            array(
                'key'		 => $top_category,
                'value'      => true,
            ),
        ),
			'posts_per_page' => $item,
		);
		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()){?>
        <div class="big-new-adv big-1">
			<div class="show-adv" id="owl-product-carousel-first-1">
			<?php while ($the_query->have_posts()){
				$the_query->the_post(); 
				?>
				<figure>
                  <a href="<?php echo get_field('url', get_the_ID()); ?>" target="_blank" title="<?php the_title(); ?>">
						<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										echo get_the_post_thumbnail(get_the_ID(), 'full',array('title' => get_the_title())); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
					</a>
					<figcaption>
						<p><a href="<?php the_permalink(); ?>" title="Xem thêm">Xem thêm</a></p>
					</figcaption>
				</figure>
		<?php	} ?>
			</div>
		</div>
<?php } ?>
