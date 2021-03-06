<?php
	wp_reset_postdata();
	$width = 300;
	$height = 300;
    $char = 18;
	if(wpmd_is_phone())
	{
		$width = 360;
		$height = 240;
        $char = 12;
	}
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
			'posts_per_page' => 12,
		);
		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()):?>
		<ul class="row">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
      <li class="col-md-3 col-sm-4 col-xs-6 show-article">
        <figure>
          <?php if(get_field('new')): ?>
          <div class="news-icon"><span>New</span></div>
          <?php else: ?>
            <?php if(get_field('page_hot')): ?>
            <div class="news-icon hot"><span>Hot</span></div>
            <?php endif; ?>
          <?php endif; ?>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array($width,$height)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
            <div class="blur"></div>
            <?php if(get_field('quan')): ?>
            <div class="fs-state-vote"><?php echo get_field('quan'); ?></div>
            <?php endif; ?>
          </a>

          <figcaption>
            <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            <?php if(get_field('gia')): ?>
            <p class="fs-pr">Giá: <var><?php echo get_field('gia'); ?></var></p>
            <?php endif; ?>

            <?php if(get_field('dien_tich')): ?>
            <p class="fs-pr">Diện tích: <?php echo get_field('dien_tich'); ?>m<span>2</span></p>
            <?php endif; ?>
            <?php if(get_the_excerpt()): ?>
            <p class="description">
							<?php echo the_excerpt_max_charlength($char); ?>
						</p>
                        <?php endif; ?>
                        
						<p class="description">
							<?php echo the_excerpt_max_charlength($char); ?>
						</p> 
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
			'posts_per_page' => 12,
		);
  $the_post_query = new WP_Query( $arg ); 
		if($the_post_query->have_posts()): ?>
		<ul class="row">
			<?php while ($the_post_query->have_posts()){ 
				$the_post_query->the_post(); 
				?>
      <li class="col-md-3 col-sm-4 col-xs-6 show-article">
        <figure>
          <?php if(get_field('new')): ?>
          <div class="news-icon"><span>New</span></div>
          <?php else: ?>
            <?php if(get_field('page_hot')): ?>
            <div class="news-icon hot"><span>Hot</span></div>
            <?php endif; ?>
          <?php endif; ?>
            
          
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array(300,300)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
            <div class="blur"></div>
            <?php if(get_field('quan')): ?>
            <div class="fs-state-vote"><?php echo get_field('quan'); ?></div>
            <?php endif; ?>
          </a>

          <figcaption>
            <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            <?php if(get_field('gia')): ?>
            <p class="fs-pr">Giá: <var><?php echo get_field('gia'); ?></var></p>
            <?php endif; ?>

            <?php if(get_field('dien_tich')): ?>
            <p class="fs-pr">Diện tích: <?php echo get_field('dien_tich'); ?></p>
            <?php endif; ?>
            <?php if(get_the_excerpt()): ?>
            <p class="description">
							<?php echo the_excerpt_max_charlength($char); ?>
						</p>
                        <?php endif; ?>
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
