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
                'key'		 => 'hot',
                'value'      => true,
            ),
        ),
			'posts_per_page' => 8,
		);
		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()):?>
		<ul class="row">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
      <li class="col-md-2 col-sm-2 col-xs-6 show-article">
        <figure>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array(183,122)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
            <div class="blur"></div>
          </a>

          <figcaption>
            <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            <?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
            <p>
              <span>Bình chọn:</span>
              <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
            </p>
          </figcaption>
      </figure>
      </li>

		<?php	} ?>
		</ul>
<?php else: ?>
<?php
wp_reset_postdata();
	$arg = array (					 
			'post_status'    => 'publish',		
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_type'      => 'post',
			'category_name'  => 'news',
			'posts_per_page' => 8,
		);
  $the_post_query = new WP_Query( $arg ); 
		if($the_post_query->have_posts()): ?>
		<ul class="row">
			<?php while ($the_post_query->have_posts()){ 
				$the_post_query->the_post(); 
				?>
      <li class="col-md-2 col-sm-2 col-xs-6 show-article">
        <figure>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array(183,122)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
            <div class="blur"></div>
          </a>

          <figcaption>
            <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            <?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
            <p>
              <span>Bình chọn:</span>
              <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
            </p>
          </figcaption>
      </figure>
      </li>

		<?php	} ?>
		</ul>
    <?php endif; ?>
<?php endif; ?>
