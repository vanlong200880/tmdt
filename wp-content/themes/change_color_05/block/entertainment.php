<?php
$parentId = get_category_by_slug('giai-tri');
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
if(wpmd_is_tablet()){
	$width = 380;
	$height = 380;
}
if(wpmd_is_phone())
{
	$width = 767;
	$height = 767;
}
if($cats){
	?>
    <div class="row entertainment">
	<?php 
    $count = 1;
	foreach ($cats as $value){ ?>
      <?php if($value->count > 0): ?>
      <div class="col-md-12">
        <div class="show-title-article">
          <?php if($count === 1): ?>
          <h1>
            <strong><?php echo $value->name; ?> </strong>
          </h1>
          <?php else: ?>
          <h2>
            <strong><?php echo $value->name; ?> </strong>
          </h2>
          <?php endif; ?>
          <?php $count++; ?>
        </div>
      </div>
      <div class="col-md-12">
        <div class="list-icon page-list-icon">
            <?php 
                  $args = array (					 
                    'post_status'    => 'publish',		
                    'order'          => 'DESC',
                    'orderby'        => 'menu_order',
                    'post_type'      => 'post',
                    'category_name'  => $value->slug,
                    'posts_per_page' => -1,
                  );
                  $the_query = new WP_Query( $args );
                  if($the_query->have_posts()){ ?>
                  <ul class="row">
                  <?php
                    while ($the_query->have_posts()){
                      $the_query->the_post(); ?>
                    <li class="col-md-2 col-sm-3 col-xs-3">
                      <a href="<?php echo get_field('url'); ?>" target="_blank">
                        <p class="img">
                        <?php
                          $attachment_id = get_post_thumbnail_id(get_the_ID());
                          if (!empty($attachment_id))
                              echo get_the_post_thumbnail(get_the_ID(), array(376,251), array('title' => get_the_title()));
                          ?>  
                        </p>
                        <p><?php the_title(); ?></p>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                  <?php } ?>
        </div>
      </div>
      <?php endif; ?>
<?php } ?>
</div>
<?php } ?>