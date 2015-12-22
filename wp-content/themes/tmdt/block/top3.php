<?php
	wp_reset_postdata();
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
			'posts_per_page' => 3,
		);
		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()){?>
		<div class="top-sub-adv">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
      <div class="show-adv">
        <figure>
          <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/health-1.jpg" alt=""></a>
          <figcaption>
            <p>
              <a href=""<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            <?php if(get_field('address')): ?>
            <p class="address"><?php echo get_field('address'); ?></p>
            <?php endif; ?>
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
