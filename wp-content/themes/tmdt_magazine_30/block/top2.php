<?php
	wp_reset_postdata();
  $item = 6;
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
  $slug = 'news';
  $top_category = 'advertisement_top';
  $category = get_queried_object();
  if(!empty($category->slug)){
    $slug = $category->slug;
    if($slug ==='xe-cong-nghe-moi'){
      $slug = 'xe-cong-nghe';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='thoi-trang-suc-khoe-moi'){
      $slug = 'thoi-trang-suc-khoe';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='nguon-dia-oc-moi') {
      $slug = 'nguon-dia-oc';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='dien-gia-dung-moi') {
      $slug = 'dien-gia-dung';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='am-thuc-tiec-moi') {
      $slug = 'am-thuc-tiec';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug ==='4-mua-khuyen-mai-moi') {
      $slug = '4-mua-khuyen-mai';
      $top_category = 'quang_cao_top_3_trang_tap_chi_moi';
    }
    elseif($slug =='khuyen-mai'){
      $slug = '4-mua-khuyen-mai,am-thuc-tiec,dien-gia-dung,nguon-dia-oc,thoi-trang-suc-khoe,xe-cong-nghe';
      $top_category = 'quang_cao_top_3_trang_khuyen_mai';
    }
    elseif($slug =='copon'){
      $slug = '4-mua-khuyen-mai,am-thuc-tiec,dien-gia-dung,nguon-dia-oc,thoi-trang-suc-khoe,xe-cong-nghe';
      $top_category = 'quang_cao_top_3_trang_coupon';
    }else{
      $top_category = 'top_category';
    }
  }
  if(is_page('page-tap-chi-online')){
    $slug = '4-mua-khuyen-mai,am-thuc-tiec,dien-gia-dung,nguon-dia-oc,thoi-trang-suc-khoe,xe-cong-nghe';
    $top_category = 'quang_cao_top_3_trang_tạp_chi';
  }
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
        $count = 0;
		if($the_query->have_posts()){?>
		<div class="top-sub-adv <?php echo $row; ?>">
			<?php while ($the_query->have_posts()){
              $count++;
				$the_query->the_post(); 
                $link = get_field('url', get_the_ID());
                if( $count > 4 ):
				?>
      <div class="show-adv <?php echo $col; ?>">
        <figure class="abc">
          <a href="<?php echo $link ?>" target="_blank" title="<?php the_title(); ?>">
						<?php
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail('full'); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
					</a>
        </figure>
      </div>
          <?php endif; ?>
		<?php	} ?>
		</div>
<?php } ?>
