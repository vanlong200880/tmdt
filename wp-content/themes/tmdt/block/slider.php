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
                'key'		 => 'advertisement_slider',
                'value'      => true,
            ),
        ),
			'posts_per_page' => 5,
		);
		$the_query = new WP_Query( $args ); 
//		var_dump($the_query);
		if($the_query->have_posts()){?>
		<div class="big-new-adv">
			<div class="show-adv" id="owl-product-carousel-first">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
				<figure>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array(800, 533)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
<!--						<img src="<?php echo get_template_directory_uri(); ?>/images/adv-1.jpg" alt="">-->
					</a>
					<figcaption>
						<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
						<p class="address"><?php echo get_field('address'); ?></p>
						<p>
							<span>Bình chọn:</span>
							<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
							<?php //if(function_exists('the_ratings')) { the_ratings(); } ?>
						</p>
					</figcaption>
				</figure>
		<?php	} ?>
			</div>
		</div>
		
<?php } ?>
