<?php
global $language;
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
  <li class="color-item-magazine">
    <a href="<?php echo get_site_url() ?>/page-tap-chi-online/" target="_blank" title="Copon">
      <!--<span class="icon-copon icon-icon-health-copon"></span>-->
        <?php echo ($language =='en')?'Newest magazine':'Tạp chí online'; ?></a>
  </li>
  <li class="color-item-sale">
    <a href="<?php echo get_site_url() ?>/khuyen-mai/" title="Khuyến mãi">
      <!--<span class="icon-sale icon-icon-health-sale"></span>-->
        <?php echo ($language =='en')?'Promotion':'Doanh nghiệp khuyến mãi'; ?></a>
  </li>
  <li class="color-item-copon">
    <a href="<?php echo get_site_url() ?>" title="Copon">
      <!--<span class="icon-copon icon-icon-health-copon"></span>-->
       Voucher <!--<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_new.gif" width="36"> --></a>
  </li>
  <li class="color-item-9">
    <a href="javascript:void(0)" title="Copon">
      <!--<span class="icon-9 icon-icon-health-9"></span>-->
        <?php echo ($language =='en')?'Vehicle & Technology':'Xe & Công nghệ'; ?></a>
    <ul class="menu-level color-item-9">
      <li><a href="<?php echo get_site_url() ?>/category/tap-chi-moi/xe-cong-nghe-moi/"><?php echo ($language =='en')?'new updated':'Mới cập nhật'; ?> </a></li>
      <li><a href="<?php echo get_site_url() ?>/category/news/xe-cong-nghe/"><?php echo ($language =='en')?'Business news':'Tin doanh nghiệp'; ?>  </a></li>
    </ul>
  </li>
  
  <li class="color-item-5">
    <a href="javascript:void(0)" title="Copon">
      <!--<span class="icon-5 icon-icon-health-5"></span>-->
        <?php echo ($language =='en')?'Fashion & Health':'Thời trang & Sức khỏe'; ?></a>
    <ul class="menu-level color-item-5">
      <li><a href="<?php echo get_site_url() ?>/category/tap-chi-moi/thoi-trang-suc-khoe-moi/"><?php echo ($language =='en')?'new updated':'Mới cập nhật'; ?> </a></li>
      <li><a href="<?php echo get_site_url() ?>/category/news/thoi-trang-suc-khoe/"><?php echo ($language =='en')?'Business news':'Tin doanh nghiệp'; ?>  </a></li>
    </ul>
  </li>
  <li class="color-item-4">
    <a href="javascript:void(0)" title="Copon">
      <!--<span class="icon-4 icon-icon-health-4"></span>-->
        <?php echo ($language =='en')?'Real Estate Source':'Nguồn địa ốc'; ?></a>
    <ul class="menu-level color-item-4">
      <li><a href="<?php echo get_site_url() ?>/category/tap-chi-moi/nguon-dia-oc-moi/"><?php echo ($language =='en')?'new updated':'Mới cập nhật'; ?> </a></li>
      <li><a href="<?php echo get_site_url() ?>/category/news/nguon-dia-oc/"><?php echo ($language =='en')?'Business news':'Tin doanh nghiệp'; ?>  </a></li>
    </ul>
  </li>
  <li class="color-item-8">
    <a href="javascript:void(0)" title="Copon">
      <!--<span class="icon-8 icon-icon-health-8"></span>-->
        <?php echo ($language =='en')?'Home & Electronics':'Điện máy & Gia dụng'; ?></a>
    <ul class="menu-level color-item-8">
      <li><a href="<?php echo get_site_url() ?>/category/tap-chi-moi/dien-gia-dung-moi/"><?php echo ($language =='en')?'new updated':'Mới cập nhật'; ?> </a></li>
      <li><a href="<?php echo get_site_url() ?>/category/news/dien-gia-dung/"><?php echo ($language =='en')?'Business news':'Tin doanh nghiệp'; ?>  </a></li>
    </ul>
  </li>
  
  <li class="color-item-6">
    <a href="javascript:void(0)" title="Copon">
      <!--<span class="icon-6 icon-icon-health-6"></span>-->
        <?php echo ($language =='en')?'Taste & Event':'Ẩm thực & Tiệc'; ?></a>
    <ul class="menu-level color-item-6">
      <li><a href="<?php echo get_site_url() ?>/category/tap-chi-moi/am-thuc-tiec-moi/"><?php echo ($language =='en')?'new updated':'Mới cập nhật'; ?> </a></li>
      <li><a href="<?php echo get_site_url() ?>/category/news/am-thuc-tiec/"><?php echo ($language =='en')?'Business news':'Tin doanh nghiệp'; ?>  </a></li>
    </ul>
  </li>
  <li class="color-item-7">
    <a href="javascript:void(0)" title="Copon">
      <!--<span class="icon-7 icon-icon-health-7"></span>-->
        <?php echo ($language =='en')?'4 Seasons & Promotion':'4 Mùa & Khuyến mãi'; ?></a>
    <ul class="menu-level color-item-7">
      <li><a href="<?php echo get_site_url() ?>/category/tap-chi-moi/4-mua-khuyen-mai-moi/"><?php echo ($language =='en')?'new updated':'Mới cập nhật'; ?> </a></li>
      <li><a href="<?php echo get_site_url() ?>/category/news/4-mua-khuyen-mai/"><?php echo ($language =='en')?'Business news':'Tin doanh nghiệp'; ?>  </a></li>
    </ul>
  </li>
	<?php 
	 //foreach ( $sorted_cats as $category ) { ?>
<!--		<li class="color-item-<?php //echo $category->term_id; ?> <?php //echo $category->slug; ?>">
			<a href="<?php //echo get_category_link( $category->term_id ); ?>" title="<?php //echo $category->name; ?>"><span class="icon-<?php //echo $category->term_id; ?> icon-icon-health-<?php //echo $category->term_id; ?>"></span><?php //echo trim($category->name); ?>
			</a>
		</li>-->
<?php//	 } ?>
		<?php
}
?>