<?php
	wp_reset_postdata();
  $item = 3;
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
    $slug= $category->slug;
    $top_category = 'top_category';
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
		if($the_query->have_posts()){?>
		<div class="top-sub-adv <?php echo $row; ?>">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
      <div class="show-adv <?php echo $col; ?>">
        <figure>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail('full'); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
					</a>
          <figcaption>
            <p>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
						<p class="address"><?php echo the_excerpt_max_charlength($char); ?></p>
            <p>
              <span>Bình chọn:</span>
              <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
            </p>
          </figcaption>
        </figure>
      </div>
		<?php	} ?>
		</div>
<?php } ?>
