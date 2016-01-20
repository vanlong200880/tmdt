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
$width = 280;
$height = 200;
if(wpmd_is_tablet()){
	$width = 380;
	$height = 300;
}
if(wpmd_is_phone())
{
	$width = 767;
	$height = 511;
}
if($cats){
	?>
<section class="all-article">
  <div class="container">
    <div class="row">
	<?php 
	$count = 1;
	$adv_count = 2;
	foreach ($cats as $value){
    if(wpmd_is_tablet()){ ?>
      <div class="col-md-6">
        <div class="show-title-article">
          <h2>
            <a href="<?php echo get_category_link( $value->term_id ); ?>">
							<?php
								if($value->slug == 'nguon-dia-oc'){
										$name = explode(' ', $value->name, 2);
										echo '<span>'.$name[0]. '</span> '.$name[1]; 
									}else{
										$name = str_replace(array("amp;","&", '&#38;', '&amp;', '--'), '-', $value->name);
										$name = explode('-', $name);
										echo '<span>'.$name[0]. '</span>'; 
										echo (!empty($name[1]))? '&'.$name[1]: '';
									}
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
										the_post_thumbnail(array($width, $height)); ?>
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
											<p class="address">
												<?php echo the_excerpt_max_charlength(20); ?>
											</p>
										<p>
											<span>Bình chọn:</span>
											<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
										</p>
										</div>
										<?php if(get_field('address')): ?>
											<p class="description"><?php echo the_excerpt_max_charlength(20); ?></p>
										<?php endif; ?>
		
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
						'posts_per_page' => 3,
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
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                      <?php 
                        $attachment_id = get_post_thumbnail_id(get_the_ID());
                        if (!empty($attachment_id)) { 
                          the_post_thumbnail(array($width, $height)); ?>
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
											<?php if(wpmd_is_phone()): ?>
											<p class="address">
												<?php echo the_excerpt_max_charlength(12); ?>
											</p>
											<?php endif; ?>
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
   <?php }else{
      
		switch ($count){
			case 1:
			case 2: ?>
			<div class="col-md-6">
				<div class="show-title-article">
          <h2>
            <a href="<?php echo get_category_link( $value->term_id ); ?>">
							<?php
								if($value->slug == 'nguon-dia-oc'){
										$name = explode(' ', $value->name, 2);
										echo '<span>'.$name[0]. '</span> '.$name[1]; 
									}else{
										$name = str_replace(array("amp;","&", '&#38;', '&amp;', '--'), '-', $value->name);
										$name = explode('-', $name);
										echo '<span>'.$name[0]. '</span>'; 
										echo (!empty($name[1]))? '&'.$name[1]: '';
									}
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
							<div class="show-large show-large-2 show-big">
								<figure>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
									$attachment_id = get_post_thumbnail_id(get_the_ID());
									if (!empty($attachment_id)) { 
										the_post_thumbnail(array($width, $height)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
										<div class="wrapp-info">
											<p class="address">
												<?php echo the_excerpt_max_charlength(30); ?>
											</p>
											<p>
												<span>Bình chọn:</span>
												<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
											</p>
										</div>
										
										<?php if(get_field('address')): ?>
											<p class="description"><?php echo the_excerpt_max_charlength(20); ?></p>
										<?php endif; ?>
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
										the_post_thumbnail(array($width, $height)); ?>
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
									<?php if(wpmd_is_phone()): ?>
									<p class="address">
										<?php echo the_excerpt_max_charlength(15); ?>
									</p>
									<?php endif; ?>
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
								if($value->slug == 'nguon-dia-oc'){
									$name = explode(' ', $value->name, 2);
									echo '<span>'.$name[0]. '</span> '.$name[1]; 
								}else{
									$name = str_replace(array("amp;","&", '&#38;', '&amp;', '--'), '-', $value->name);
									$name = explode('-', $name);
									echo '<span>'.$name[0]. '</span>'; 
									echo (!empty($name[1]))? '&'.$name[1]: '';
								}
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
										the_post_thumbnail(array($width, $height)); ?>
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
											<p class="address">
												<?php echo the_excerpt_max_charlength(20); ?>
											</p>
										<p>
											<span>Bình chọn:</span>
											<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
										</p>
										</div>
										<?php if(get_field('address')): ?>
											<p class="description"><?php echo the_excerpt_max_charlength(20); ?></p>
										<?php endif; ?>
		
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
						'posts_per_page' => 3,
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
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                      <?php 
                        $attachment_id = get_post_thumbnail_id(get_the_ID());
                        if (!empty($attachment_id)) { 
                          the_post_thumbnail(array($width, $height)); ?>
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
											<?php if(wpmd_is_phone()): ?>
											<p class="address">
												<?php echo the_excerpt_max_charlength(12); ?>
											</p>
											<?php endif; ?>
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
  }
		$count++;
		$adv_count++;
		if($count > 4)
			$count = 1;
	} ?>
		</div>
	</div>
</section>
<?php } ?>