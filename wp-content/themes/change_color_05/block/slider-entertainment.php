<?php
	wp_reset_postdata();
  $slug = 'quang-cao';
  $adv_category = 'advertisement_slider';
  $category = get_queried_object();
  if(!empty($category->slug)){
    $slug= $category->slug;
    if($slug ==='giai-tri'){
      $slug = 'giai-tri-quang-cao';
        $adv_category = 'advertisement_page_entertainment';
    }
	$args = array (
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'post_date',
			'post_type'      => 'post',
			'category_name'  => $slug,
			'meta_query'     => array(
            array(
                'key'		 => $adv_category,
                'value'      => true,
            ),
        ),
			'posts_per_page' => 8,
		);
		$the_query = new WP_Query( $args );
//        var_dump($the_query);
		if($the_query->have_posts()){?>
		<div class="big-new-adv">
			<div class="show-adv" id="owl-product-carousel-first">
			<?php while ($the_query->have_posts()){ 
				$the_query->the_post(); 
				?>
				<figure>
                  <a href="<?php echo get_field('url', get_the_ID()); ?>" target="_blank" title="<?php the_title(); ?>">
						<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										echo get_the_post_thumbnail(get_the_ID(), 'full',array('title' => get_the_title())); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
					</a>
					<figcaption>
						<p><a href="<?php echo get_field('url', get_the_ID()); ?>" title="Xem thêm">Xem thêm</a></p>
					</figcaption>
				</figure>
		<?php	} ?>
			</div>
		</div>
		

<?php } ?>
<?php } ?>
