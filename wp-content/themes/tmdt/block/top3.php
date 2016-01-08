<?php
	wp_reset_postdata();
  $item = 3;
  if(wpmd_is_tablet()){
    $item = 6;
  }
	$args = array (					 
			'post_status'    => 'publish',		
			'order'          => 'DESC',
			'orderby'        => 'menu_order',
			'post_type'      => 'post',
			'category_name'  => 'news',
			'meta_query'     => array(
            array(
                'key'		 => 'advertisement_top',
                'value'      => true,
            ),
        ),
			'posts_per_page' => $item,
		);
		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()){?>
		<div class="top-sub-adv">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
      <div class="show-adv">
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
						<p class="address"><?php the_excerpt_max_charlength(25); ?></p>
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
