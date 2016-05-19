<?php
	wp_reset_postdata();
  $slug = 'quang-cao';
  $adv_category = 'advertisement_slider';
  $category = get_queried_object();
  if(!empty($category->slug)){
    $slug= $category->slug;
    if($slug ==='du-lich'){
      $slug = 'du-lich-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    if($slug ==='xe-cong-nghe'){
      $slug = 'xe-cong-nghe-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    if($slug ==='thoi-trang-suc-khoe'){
      $slug = 'thoi-trang-suc-khoe-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    if($slug ==='nguon-dia-oc' ){
      $slug = 'nguon-dia-oc-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    if($slug ==='dien-gia-dung'){
      $slug = 'dien-gia-dung-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    if($slug ==='am-thuc-tiec'){
      $slug = 'am-thuc-tiec-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    if($slug ==='4-mua-khuyen-mai'){
      $slug = '4-mua-khuyen-mai-quang-cao';
      $top_category = 'advertisement_top_category';
    }
    
    if($slug ==='xe-cong-nghe-moi'){
      $slug = 'xe-cong-nghe-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='thoi-trang-suc-khoe-moi' ){
      $slug = 'thoi-trang-suc-khoe-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='nguon-dia-oc-moi' ) {
      $slug = 'nguon-dia-oc-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='dien-gia-dung-moi') {
      $slug = 'dien-gia-dung-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='am-thuc-tiec-moi' ) {
      $slug = 'am-thuc-tiec-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='4-mua-khuyen-mai-moi' ) {
      $slug = '4-mua-khuyen-mai-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug =='khuyen-mai'){
      $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
      $adv_category = 'quang_cao_slider_trang_khuyen_mai';
    }
    elseif($slug =='tap-chi-moi'){
      $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug =='copon'){
      $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
      $adv_category = 'quang_cao_slider_trang_coupon';
    }else{
      $adv_category = 'advertisement_top_category';
    }
  }
  // Magazine online
  $arrMagazine = array('tap-chi-online','4-mua-khuyen-mai-online', 'am-thuc-tiec-online', 'dien-gia-dung-online', 'nguon-dia-oc-online', 'thoi-trang-suc-khoe-online', 'xe-cong-nghe-online');
  if(in_array($slug, $arrMagazine)){
    $slug = '4-mua-khuyen-mai-quang-cao,am-thuc-tiec-quang-cao,dien-gia-dung-quang-cao,nguon-dia-oc-quang-cao,thoi-trang-suc-khoe-quang-cao,xe-cong-nghe-quang-cao';
    $adv_category = 'quang_cao_slider_trang_tap_chi';
  }
	$args = array (
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'post_date',
			'post_type'      => 'post',
			'category_name'  => $slug,
			'meta_query'     => array(
            array(
                'key'		 => $adv_category,
                'value'      => true,
            ),
        ),
			'posts_per_page' => 8,
		);
		$the_query = new WP_Query( $args );
//		var_dump($the_query); die;
		if($the_query->have_posts()){?>
		<div class="big-new-adv">
			<div class="show-adv" id="owl-product-carousel-first">
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
						<p><a href="<?php echo get_field('url', get_the_ID()); ?>" title="Xem thêm">Xem thêm</a></p>
					</figcaption>
				</figure>
		<?php	} ?>
			</div>
		</div>
		

<?php } ?>
