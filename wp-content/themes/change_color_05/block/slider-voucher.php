<?php
    $category = get_queried_object();
    
    if($category->slug){
      $slug = $category->slug;
    }else{
      $slug = 'voucher-moi';
    }
	$args = array (
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'menu_order',
			'post_type'      => 'post',
			'category_name'  => $slug,
			'meta_query'     => array(
            array(
                'key'		 => 'voucher_banner',
                'value'      => true,
            ),
        ),
			'posts_per_page' => 5,
		);
		$the_query = new WP_Query( $args );
		if($the_query->have_posts()){?>
		<ul id="owl-voucher">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
                  <li>
                    <a href="<?php echo get_field('url', get_the_ID()); ?>" target="_blank">
                      <?php 
                        $attachment_id = get_post_thumbnail_id(get_the_ID());
                        if (!empty($attachment_id))
                            echo get_the_post_thumbnail(get_the_ID(), 'full', array('title' => get_the_title())); ?>
                    </a>
                  </li>
		<?php	} ?>
        </ul>
		

<?php } ?>
