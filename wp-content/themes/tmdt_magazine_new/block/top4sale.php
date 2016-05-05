<?php
	wp_reset_postdata();
	$width = 320;
	$height = 320;
    $char = 18;
	if(wpmd_is_phone())
	{
		$width = 360;
		$height = 360;
        $char = 12;
	}
	$args = array (
			'post_status'    => 'publish',
            'post_type'      => 'post',
			'category_name'  => 'khuyen-mai',
            'order'				=> 'DESC',
            'meta_key'			=> 'sort_by',
            'orderby'			=> 'meta_value post_date',
//			'meta_query'     => array(
//            array(
//                'key'		 => 'hot',
//                'value'      => true,
//            ),
//        ),
			'posts_per_page' => 4,
		);
		$the_query = new WP_Query( $args );
		if($the_query->have_posts()):?>
		<ul class="row">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post();
                $category_cat = get_the_category();
                $class = '';
                if($category_cat && $category_cat[0]->slug != 'nguon-dia-oc'){
                  $class = 'not-real';
                  $char = 16;
                }
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
            <p class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            
            <?php if(get_the_excerpt()): ?>
            <p class="description <?php echo $class; ?>">
							<?php echo the_excerpt_max_charlength($char); ?>
						</p>
                        <?php endif; ?>
            <?php if(get_field('gia') && get_field('dien_tich')): ?>
            <div class="sf-price">
              
              <p class="fs-pr">Giá: <var><?php echo get_field('gia'); ?></var></p>
              <p class="fs-pr fs-dt">Diện tích: <?php echo get_field('dien_tich'); ?></p>
            </div>
            <?php endif; ?>
                        
                        <div class="fs-comment">
              <span>Bình chọn:</span>
              <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
            </div>
          </figcaption>
      </figure>
      </li>
			
		<?php	} ?>
		</ul>
<?php endif; ?>
