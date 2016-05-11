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
$width = 320;
$height = 320;
$item = 4;
if(wpmd_is_tablet()){
	$width = 380;
	$height = 380;
    $item = 3;
}
if(wpmd_is_phone())
{
	$width = 767;
	$height = 767;
}
if($cats){
	?>
	<?php 
	$count = 1;
	$adv_count = 2;
	foreach ($cats as $value){
      $args1 = array (
        'post_status'    => 'publish',
        'post_type'      => 'post',
        'category_name'  => $value->slug,
        'order'				=> 'DESC',
        'meta_key'			=> 'sort_by',
        'orderby'			=> 'meta_value post_date',


        'meta_query'     => array(
          array(
            'key'		 => 'hot',
            'value'      => true,
          ),
        ),
        'posts_per_page' => $item,
      );
      $the_query = new WP_Query( $args1 );
		if($the_query->have_posts()): ?>
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
										echo get_the_post_thumbnail(get_the_ID(), array($width,$height), array('title' => get_the_title())); ?>
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
              <?php //echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
              <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
            </div>
          </figcaption>
      </figure>
      </li>
			
		<?php	} ?>
		</ul>
<?php endif; ?>
<?php	} ?>
<?php } ?>