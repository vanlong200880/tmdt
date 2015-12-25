<?php
	wp_reset_postdata();
	$tab_args = array (					 
			'post_status'    => 'publish',		
			'order'          => 'DESC',
			'orderby'        => 'menu_order',
			'post_type'      => 'post',
			'category_name'  => 'news',
			'posts_per_page' => 12,
		);
		$tab_the_query = new WP_Query( $tab_args ); 
		
		$arrSortTab = array();
		if($tab_the_query->have_posts()):?>
		<?php while ($tab_the_query->have_posts()){
			$tab_the_query->the_post();
			$tab_the_query->post->vote = uni_get_total_rating_by_post(get_the_ID());
				$arrSortTab[] = $tab_the_query->post;
		}
		usort($arrSortTab, function($a, $b) {
			return $b->vote - $a->vote;
		});
		$tab_the_query->posts = $arrSortTab;
		?>
		<ul class="row">
			<?php while ($tab_the_query->have_posts()){
				$tab_the_query->the_post();
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
    <div class="row">
      <div class="col-md-12">Dữ liệu đang cập nhật.</div>
    </div>
    <?php endif; ?>