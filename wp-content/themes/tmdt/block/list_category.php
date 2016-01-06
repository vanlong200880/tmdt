<section id="wrapp-adv-device">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
					<?php echo adrotate_group(1); ?>
      </div>
    </div>
  </div>
</section>
<?php
$parentId = get_category_by_slug('news');
$args = array(
	'category_custom_field' => 'category_order',
	'orderby'           => 'category_order',
	'order'             => 'DESC',
	'parent'            => $parentId->term_id,
	'taxonomy'          => 'category',
	'hide_empty'        => 0
);
$categories = get_categories( $args );
$cats = array();
	foreach($categories as $cat){
		$ordr = get_field('category_order', 'category_'.$cat->term_id);
		$cat->order = $ordr;
		$cats[] = $cat;
	}
	usort($cats, function($a, $b) {
    return $a->order - $b->order;
});

if($cats){
	?>
<section class="all-article">
  <div class="container">
    <div class="row">
	<?php 
	$count = 1;
	$adv_count = 1;
	foreach ($cats as $value){
		switch ($count){
			case 1:
			case 2: ?>
			<div class="col-md-6">
				<div class="show-title-article">
          <h2>
            <a href="<?php echo get_category_link( $value->term_id ); ?>">
							<?php
							$name = str_replace(array("amp;","&", '&#38;', '&amp;', '--'), '-', $value->name);
							$name = explode('-', $name);
							echo '<span>'.$name[0]. '</span>'; 
							echo (!empty($name[1]))? '&'.$name[1]: '';
							?> 
            </a>
          </h2>
        </div>
				<div class="row">
			<?php 
				$args = array (					 
					'post_status'    => 'publish',		
					'order'          => 'DESC',
					'orderby'        => 'menu_order date',
					'post_type'      => 'post',
					'category_name'  => $value->slug,
					'meta_query'     => array(
            array(
                'key'		 => 'highlight_big',
                'value'      => true,
            ),
					),
					'posts_per_page' => 1,
				);
				$the_query = new WP_Query( $args );
				if($the_query->have_posts()){
					// list post
					while ($the_query->have_posts()){
						$the_query->the_post(); ?>
						<div class="col-md-12 col-sm-12- col-xs-12">
							<div class="show-large show-large-2">
								<figure>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array(269, 179)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
										<div class="wrapp-info">
											<?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
											<p>
												<span>Bình chọn:</span>
												<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
											</p>
										</div>
										<?php if(get_field('short_description')): ?><p class="description"><?php echo get_field('short_description'); ?></p> <?php endif; ?>
									</figcaption>
								</figure>
							</div>
						</div>
					<?php }
				} ?>
					
				<!--Top 4--> 
				<?php 
				wp_reset_postdata();
				$top4_args = array (					 
					'post_status'    => 'publish',		
					'order'          => 'DESC',
					'orderby'        => 'menu_order',
					'post_type'      => 'post',
					'category_name'  => $value->slug,
					'meta_query'     => array(
            array(
                'key'		 => 'highlight_small',
                'value'      => true,
            ),
					),
					'posts_per_page' => 4,
				);
				$top4_the_query = new WP_Query( $top4_args );
				if($top4_the_query->have_posts()){ ?>
				<div class="col-md-12 col-sm-12- col-xs-12">
				<?php 	// list post top 4
					while ($top4_the_query->have_posts()){
						$top4_the_query->the_post(); ?>
					<div class="show-sub show-sub-2">
              <figure>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array(269, 179)); ?>
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
            </div>
					
					<?php } ?>
				</div>
				<?php }
				?>
					<div class="col-md-12 col-sm-12- col-xs-12">
						<section id="wrapp-adv-device"><?php echo adrotate_ad($adv_count); ?></section>
					</div>
				</div>
			</div>
				<?php
				break;
			case 3:
			case 4: ?>
			<div class="col-md-6">
				<div class="show-title-article">
          <h2>
            <a href="<?php echo get_category_link( $value->term_id ); ?>">
							<?php 
								$name = str_replace(array("amp;","&", '&#38;', '&amp;', '--'), '-', $value->name);
								$name = explode('-', $name);
								echo '<span>'.$name[0]. '</span>'; 
								echo (!empty($name[1]))? '&'.$name[1]: '';
							?> 
            </a>
          </h2>
        </div>
				<div class="row">
					<?php 
					$args = array (					 
						'post_status'    => 'publish',		
						'order'          => 'DESC',
						'orderby'        => 'menu_order',
						'post_type'      => 'post',
						'category_name'  => $value->slug,
						'meta_query'     => array(
							array(
									'key'		 => 'highlight_big',
									'value'      => true,
							),
						),
						'posts_per_page' => 1,
					);
					$the_query = new WP_Query( $args );
					if($the_query->have_posts()){ ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						// list post
						while ($the_query->have_posts()){
							$the_query->the_post(); ?>
							<div class="show-large">
								<figure>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) {
										the_post_thumbnail(array(269, 179)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
										<div class="blur"></div>
									</a>
									<figcaption>
										<p>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<?php the_title(); ?>
											</a>
										</p>
										<div class="wrapp-info">
											<?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
										<p>
											<span>Bình chọn:</span>
											<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
										</p>
										</div>
										<?php if(get_field('short_description')): ?><p class="description"><?php echo get_field('short_description'); ?></p> <?php endif; ?>
		
									</figcaption>
								</figure>
							</div>
						<?php } ?>
					</div>
					<?php }
					?>
	
					<?php 
					$args = array (					 
						'post_status'    => 'publish',		
						'order'          => 'DESC',
						'orderby'        => 'menu_order',
						'post_type'      => 'post',
						'category_name'  => $value->slug,
						'meta_query'     => array(
							array(
									'key'		 => 'highlight_small',
									'value'      => true,
							),
						),
						'posts_per_page' => 4,
					);
					$the_query = new WP_Query( $args );
					if($the_query->have_posts()){ ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						// list post
						while ($the_query->have_posts()){
							$the_query->the_post(); ?>
								<div class="show-sub">
									<figure>
										<a href="#">
											<img src="<?php echo get_template_directory_uri(); ?>/images/elect-2.jpg" alt="">
											<div class="blur"></div>
										</a>
										<figcaption>
											<p>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
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
								</div>
						<?php } ?>
					</div>
						<?php } ?>
					<div class="col-md-12 col-sm-12- col-xs-12">
						<section id="wrapp-adv-device"><?php echo adrotate_ad($adv_count); ?></section>
					</div>
					
				</div>
			</div>
			<?php
				break;
			default :
				break;
		}
		$count++;
		$adv_count++;
		if($count > 4)
			$count = 1;
	} ?>
		</div>
	</div>
</section>
<?php }
?>







<!--

<section class="all-article">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="show-title-article">
          <h2>
            <a href="">
              <span>Nguồn</span> địa ốc
            </a>
          </h2>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12- col-xs-12">
            <div class="show-large show-large-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/real-1.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <div class="wrapp-info">
                    <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                    <p>
                      <span>Bình chọn:</span>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                    </p>
                  </div>
                  <p class="description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis nisi fugiat veritatis praesentium, laboriosam perspiciatis dolorem, modi exercitationem accusantium. Rem itaque eaque deleniti maxime excepturi, soluta. Ad, voluptates vero eligendi.
                  </p>

                </figcaption>
              </figure>
            </div>
          </div>
          <div class="col-md-12 col-sm-12- col-xs-12">
            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/real-2.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/real-3.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/real-4.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/real-2.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

          </div>
        </div>
      </div>end col-md-6


      <div class="col-md-6">
        <div class="show-title-article">
          <h2>
            <a href="">
              <span>4 mùa</span> & Khuyến mãi
            </a>
          </h2>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12- col-xs-12">
            <div class="show-large show-large-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/four-seasons-1.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <div class="wrapp-info">
                    <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                    <p>
                      <span>Bình chọn:</span>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                    </p>
                  </div>
                  <p class="description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis nisi fugiat veritatis praesentium, laboriosam perspiciatis dolorem, modi exercitationem accusantium. Rem itaque eaque deleniti maxime excepturi, soluta. Ad, voluptates vero eligendi.
                  </p>

                </figcaption>
              </figure>
            </div>
          </div>
          <div class="col-md-12 col-sm-12- col-xs-12">
            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/four-seasons-2.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/four-seasons-3.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/four-seasons-4.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub show-sub-2">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/four-seasons-1.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

          </div>
        </div>
      </div>end col-md-6


    </div>
  </div>
</section>

<section id="wrapp-adv-full">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/adv-full-2.jpg" alt=""></a>
      </div>
    </div>
  </div>
</section>

<section class="all-article">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="show-title-article">
          <h2>
            <a href="">
              <span>Điện máy</span> & Gia dụng
            </a>
          </h2>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="show-large">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/elect-1.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <div class="wrapp-info">
                    <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                    <p>
                      <span>Bình chọn:</span>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                    </p>
                  </div>
                  <p class="description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis nisi fugiat veritatis praesentium, laboriosam perspiciatis dolorem, modi exercitationem accusantium. Rem itaque eaque deleniti maxime excepturi, soluta. Ad, voluptates vero eligendi.
                  </p>

                </figcaption>
              </figure>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/elect-2.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/elect-3.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/elect-4.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/elect-5.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

          </div>
        </div>
      </div>end col-md-6


      <div class="col-md-6">
        <div class="show-title-article">
          <h2>
            <a href="">
              <span>Xe</span> & Công nghệ
            </a>
          </h2>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="show-large">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/car-1.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <div class="wrapp-info">
                    <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                    <p>
                      <span>Bình chọn:</span>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                    </p>
                  </div>
                  <p class="description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis nisi fugiat veritatis praesentium, laboriosam perspiciatis dolorem, modi exercitationem accusantium. Rem itaque eaque deleniti maxime excepturi, soluta. Ad, voluptates vero eligendi.
                  </p>

                </figcaption>
              </figure>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/car-2.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/car-3.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/car-4.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

            <div class="show-sub">
              <figure>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/car-1.jpg" alt="">
                  <div class="blur"></div>
                </a>
                <figcaption>
                  <p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
                  <p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
                  <p>
                    <span>Bình chọn:</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/vote.png" alt="">
                  </p>
                </figcaption>
              </figure>
            </div>

          </div>
        </div>
      </div>end col-md-6


    </div>
  </div>
</section>

<section id="wrapp-adv-device">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12 adv-device">
        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/adv-device-3.jpg" alt=""></a>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 adv-device">
        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/adv-device-4.jpg" alt=""></a>
      </div>
    </div>
  </div>
</section>-->