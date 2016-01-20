<?php
$parentId = get_category_by_slug('news');
$args = array(
	'orderby'           => 'category_order',
	'order'             => 'DESC',
	'parent'            => $parentId->term_id,
	'taxonomy'          => 'category',
	'hide_empty'        => 0
);
$categories = get_categories( $args );
$sorted_cats = array();
	foreach($categories as $cat){
		$ordr = get_field('category_order', 'category_'.$cat->term_id);
		$cat->order = $ordr;
		$sorted_cats[] = $cat;
	}
	usort($sorted_cats, function($a, $b) {
    return $a->order - $b->order;
});
if($sorted_cats){ ?>
  <li class="color-item-sale">
    <a href="<?php echo get_site_url() ?>/khuyen-mai/" title="Khuyến mãi"><span class="icon-sale icon-icon-health-sale"></span>Khuyến mãi</a>
  </li>
  <li class="color-item-copon">
    <a href="<?php echo get_site_url() ?>/copon/" title="Copon"><span class="icon-copon icon-icon-health-copon"></span>Copon</a>
  </li>
	<?php 
	 foreach ( $sorted_cats as $category ) { ?>
		<li class="color-item-<?php echo $category->term_id; ?> <?php echo $category->slug; ?>">
			<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>"><span class="icon-<?php echo $category->term_id; ?> icon-icon-health-<?php echo $category->term_id; ?>"></span><?php echo trim($category->name); ?>
			</a>
		</li>
<?php	 } ?>
		<?php
}
?>