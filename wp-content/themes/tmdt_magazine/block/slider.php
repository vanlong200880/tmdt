<?php
	wp_reset_postdata();
  $slug = 'news';
  $adv_category = 'advertisement_slider';
  $category = get_queried_object();
  if(!empty($category->slug)){
    $slug= $category->slug;
    if($slug ==='xe-cong-nghe-moi'){
      $slug = 'xe-cong-nghe';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='thoi-trang-suc-khoe-moi'){
      $slug = 'thoi-trang-suc-khoe';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='nguon-dia-oc-moi') {
      $slug = 'nguon-dia-oc';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='dien-gia-dung-moi') {
      $slug = 'dien-gia-dung';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='am-thuc-tiec-moi') {
      $slug = 'am-thuc-tiec';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug ==='4-mua-khuyen-mai-moi') {
      $slug = '4-mua-khuyen-mai';
      $adv_category = 'quang_cao_slider_trang_tap_chi_moi';
    }
    elseif($slug =='khuyen-mai'){
      $slug = '4-mua-khuyen-mai,am-thuc-tiec,dien-gia-dung,nguon-dia-oc,thoi-trang-suc-khoe,xe-cong-nghe';
      $adv_category = 'quang_cao_slider_trang_khuyen_mai';
    }
    elseif($slug =='copon'){
      $slug = '4-mua-khuyen-mai,am-thuc-tiec,dien-gia-dung,nguon-dia-oc,thoi-trang-suc-khoe,xe-cong-nghe';
      $adv_category = 'quang_cao_slider_trang_coupon';
    }else{
      $adv_category = 'advertisement_top_category';
    }
  }
  if(is_page('page-tap-chi-online')){
    $slug = '4-mua-khuyen-mai,am-thuc-tiec,dien-gia-dung,nguon-dia-oc,thoi-trang-suc-khoe,xe-cong-nghe';
    $adv_category = 'quang_cao_slider_trang_tap_chi';
  }
	$args = array (
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'menu_order',
			'post_type'      => 'post',
			'category_name'  => $slug,
			'meta_query'     => array(
            array(
                'key'		 => $adv_category,
                'value'      => true,
            ),
        ),
			'posts_per_page' => 5,
		);
		$the_query = new WP_Query( $args ); 
//		var_dump($the_query);
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
										the_post_thumbnail('full'); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
					</a>
					<figcaption>
						<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
					</figcaption>
				</figure>
		<?php	} ?>
			</div>
		</div>
		
<?php } ?>
