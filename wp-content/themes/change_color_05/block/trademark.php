<?php
wp_reset_postdata();
  $item = 36;
  $slug  = isset($product_cat) ? $product_cat : 0;
  if($slug =='4-mua-khuyen-mai-moi'){
    $slug = '4-mua-khuyen-mai';
  }
  if($slug =='am-thuc-tiec-moi'){
    $slug = 'am-thuc-tiec';
  }
  if($slug =='dien-gia-dung-moi'){
    $slug = 'dien-gia-dung';
  }
  if($slug =='	nguon-dia-oc-moi'){
    $slug = 'nguon-dia-oc';
  }
  if($slug =='thoi-trang-suc-khoe-moi'){
    $slug = 'thoi-trang-suc-khoe';
  }
  if($slug =='xe-cong-nghe-moi'){
    $slug = 'xe-cong-nghe';
  }
  if($slug =='du-lich-moi'){
    $slug = 'du-lich';
  }
	$args = array (
      'post_status'    => 'publish',
      'orderby'        => 'post_date',
      'order'          => 'DESC',
      'post_type'      => 'post',
      'category_name'  => 'thuong-hieu-'.$slug,
      'posts_per_page' => $item,
    );
    $the_query = new WP_Query( $args ); 
    if($the_query->have_posts()){?>
      <ul class="row list-trademark">
        <?php 
        while ($the_query->have_posts()): 
          $the_query->the_post(); 
          $link = get_field('url', get_the_ID());
        ?>
        <li class="col-md-1 col-sm-2 col-xs-4">
          <a href="<?php echo $link; ?>" title="<?php the_title(); ?>">
            <?php
              $attachment_id = get_post_thumbnail_id(get_the_ID());
              if (!empty($attachment_id))
                echo get_the_post_thumbnail(get_the_ID(), 'full', array('title' => get_the_title())); ?>
          </a>
        </li>
		<?php endwhile; ?>
        </ul>
<?php } ?>
