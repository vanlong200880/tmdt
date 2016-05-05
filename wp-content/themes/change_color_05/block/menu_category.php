<?php
global $language;
//$parentId = get_category_by_slug('news');
//$args = array(
//	'orderby'           => 'category_order',
//	'order'             => 'DESC',
//	'parent'            => $parentId->term_id,
//	'taxonomy'          => 'category',
//	'hide_empty'        => 0
//);
//$categories = get_categories( $args );
//$sorted_cats = array();
//	foreach($categories as $cat){
//		$ordr = get_field('category_order', 'category_'.$cat->term_id);
//		$cat->order = $ordr;
//		$sorted_cats[] = $cat;
//	}
//	usort($sorted_cats, function($a, $b) {
//    return $a->order - $b->order;
//});
//if($sorted_cats){ ?>
  <li class="color-item-magazine">
    <a href="<?php echo get_site_url() ?>/tap-chi-online/" target="_blank" title="Copon">
      <span class="fonts fonts-magazine"></span> 
        <?php echo ($language =='en')?'Magazine':'Tạp chí online'; ?></a>
  </li>
  <li class="color-item-6">
    <a href="<?php echo get_site_url() ?>/tap-chi-moi/">
      <span class="fonts fonts-new-document"></span> 
      <strong><?php echo ($language =='en')?'New Advertising':'Mới cập nhật'; ?></strong></a>
<!--    <ul class="menu-level color-item-6">
      <li><a href="<?php //echo get_site_url() ?>/tap-chi-moi/nguon-dia-oc-moi/"><?php //echo ($language =='en')?'Real Estate Source':'Nguồn địa ốc'; ?> </a></li>
      <li><a href="<?php //echo get_site_url() ?>/tap-chi-moi/am-thuc-tiec-moi/"><?php //echo ($language =='en')?'Taste & Event':'Ẩm thực & Tiệc'; ?> </a></li>
      <li><a href="<?php //echo get_site_url() ?>/tap-chi-moi/xe-cong-nghe-moi/"><?php //echo ($language =='en')?'Vehicle & Technology':'Xe & Công nghệ'; ?> </a></li>
      <li><a href="<?php //echo get_site_url() ?>/tap-chi-moi/thoi-trang-suc-khoe-moi/"><?php //echo ($language =='en')?'Fashion & Health':'Thời trang & Sức khỏe'; ?></a></li>
      <li><a href="<?php //echo get_site_url() ?>/tap-chi-moi/dien-gia-dung-moi/"><?php //echo ($language =='en')?'Home & Electronics':'Điện máy & Gia dụng'; ?> </a></li>
      <li><a href="<?php //echo get_site_url() ?>/tap-chi-moi/4-mua-khuyen-mai-moi/"><?php //echo ($language =='en')?'4 Seasons & Promotion':'4 Mùa & Khuyến mãi'; ?> </a></li>
    </ul>-->
  </li>
  <li class="color-item-4">
    <a href="<?php echo get_site_url() ?>/nguon-dia-oc/">
      <span class="icon-4 icon-icon-health-4"></span>
        <?php echo ($language =='en')?'Real Estate Source':'Nguồn địa ốc'; ?></a>
  </li>
  <li class="color-item-5">
    <a href="<?php echo get_site_url() ?>/thoi-trang-suc-khoe/">
        <span class="icon-5 icon-icon-health-5"></span>
        <?php echo ($language =='en')?'Fashion & Health':'Thời trang & Sức khỏe'; ?></a>
  </li>
  <li class="color-item-8">
    <a href="<?php echo get_site_url() ?>/dien-gia-dung/">
      <span class="icon-8 icon-icon-health-8"></span>
        <?php echo ($language =='en')?'Home & Electronics':'Điện máy & Gia dụng'; ?></a>
  </li>
  <li class="color-item-6">
    <a href="<?php echo get_site_url() ?>/am-thuc-tiec/">
      <span class="icon-6 icon-icon-health-6"></span>
        <?php echo ($language =='en')?'Taste & Event':'Ẩm thực & Tiệc'; ?></a>
  </li>
  
  <li class="color-item-7">
    <a href="<?php echo get_site_url() ?>/du-lich/">
      <span class="fonts fonts-airplane-around-earth"></span> 
      <?php echo ($language =='en')?'Travel & Services':'Du lịch & Dịch vụ'; ?></a>
  </li>
  <li class="color-item-9">
    <a href="<?php echo get_site_url() ?>/xe-cong-nghe/">
      <span class="icon-9 icon-icon-health-9"></span>
        <?php echo ($language =='en')?'Vehicle & Technology':'Xe & Công nghệ'; ?></a>
  </li>
  <li class="color-item-7">
    <a href="<?php echo get_site_url() ?>/4-mua-khuyen-mai/">
      <span class="icon-7 icon-icon-health-7"></span>
        <?php echo ($language =='en')?'4 Seasons & Promotion':'4 Mùa & Khuyến mãi'; ?></a>
  </li>

  <li class="color-item-7">
    <a href="<?php echo get_site_url() ?>/khuyen-mai/" title="UNI - DEAL">
      <span class="fonts fonts-refresh-button"></span>
      <strong><?php echo ($language =='en')?'UNI - DEAL':'UNI - DEAL'; ?></strong></a>
  </li>
  
  <li class="color-item-copon">
    <a href="<?php echo get_site_url() ?>/voucher/" title="Copon">
      <span class="fonts fonts-clothes-tag"></span>
      <?php echo ($language =='en')?'Voucher & Coupon':'Voucher & Coupon'; ?></a>   
  </li>
  
  
  
  
  
  
  
  
  

		<?php
//}
?>