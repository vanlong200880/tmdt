<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php 
$category = get_queried_object();
$parent = get_category($category->category_parent);
if($parent->slug =='voucher'): ?>
<?php 
global $post;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
  'post_status'    => 'publish',
  'order'          => 'DESC',
  'orderby'        => 'date',
  'category_name'  => $category->slug,
  'post_type'      => 'post',
  'paged'          => $paged
);
$color = array('#34495d','#95c11e','#302683', '#009bb4', '#f39200', '#c51a1b');
$my_the_query = new WP_Query( $args );
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

?>
<div class="coupon-slider">
  <?php get_template_part('block/slider-voucher'); ?>
</div>
<?php 
$parentId = get_category_by_slug('voucher');
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
?>
<div class="list-category-voucher">
  <div class="container">
    <div class="row">
      <ul id="list-home-voucher">
        <?php 
        foreach ($cats as $value){ ?>
        <?php $active = '';
            if($value->slug == $category->slug){
              $active = 'active';
            } ?>
        <li class="col-md-2 item-coupon-list-<?php echo $value->term_id; ?> <?php echo $active; ?>">
          <a href="<?php echo get_category_link( $value->term_id ); ?>"><?php echo $value->name; ?></a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<div class="coupon-title">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Nhận voucher - Vui thả ga</h1>
      </div>
    </div>
  </div>
</div>

<div class="breadcrumb-coupon">
  <div class="container">
    <?php 
    $args_voucher = array(
          'post_status'    => 'publish',
          'order'          => 'DESC',
          'orderby'        => 'menu_order',
          'post_type'      => 'post',
          'category_name'  => $category->slug,
          'meta_query'     => array(
          array(
              'key'		 => 'voucher_banner',
              'value'    => true,
              'compare'  => '!='
          ),
        )
      );
      $my_the_query = new WP_Query( $args_voucher );
    ?>
    <?php if($my_the_query->have_posts()): ?>
    <ul class="row list-voucher-free">
      <?php
      while ($my_the_query->have_posts()){
			$my_the_query->the_post();
      ?>
      <li class="col-md-4 col-sm-6 col-xs-12">
        <div class="item-coupon">
          <div class="img">
            <?php 
//              $attachment_id = get_post_thumbnail_id(get_the_ID());
//              if (!empty($attachment_id)) { 
//                the_post_thumbnail(array(378,252));
//              }
            ?>
            <?php
                $attachment_id = get_post_thumbnail_id(get_the_ID());
                $link = wp_get_attachment_link($attachment_id, 'full');
                echo $link;
                        ?>
          </div>
          <div class="item-content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="price">
              
              <p class="sale">
                <?php 
                $sale = get_field('sale', get_the_ID());
                if($sale): ?>
                -<?php echo $sale; ?>%
                <?php endif; ?>
              </p>
              <p class="payment"><a data-code="<?php the_ID() ?>">Nhận voucher</a></p>
            </div>
          </div>
        </div>
      </li>
      <?php } ; ?>
    </ul>
    <?php else: ?>
    <div class="col-md-12">
      <div class="empty">Dữ liệu đang cập nhật.</div>
    </div>
    <?php endif; ?>
  </div>
</div>


<div class="modal fade voucher-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="icon-voucher"></div>
      <h3>Nhận</h3>
      <h2>Voucher</h2>
      <div class="form-voucher">
        <form class="form-horizontal" id="voucher_form" action="voucher_form">
          <div class="voucher-error"></div>
          <input type="hidden" id="voucher-code" name="voucher-code" value="">
          <div class="form-group">
            <label for="voucher-name">Họ và tên</label>
            <input type="text" class="form-control" id="voucher-fullname" name="fullname">
          </div>

          <div class="form-group">
            <label for="voucher-email">Email</label>
            <input type="email" class="form-control" id="voucher-email" name="email">
          </div>

          <div class="form-group">
            <label for="voucher-phone">Điện thoại</label>
            <input type="tel" class="form-control" id="voucher-phone" name="phone">
          </div>
          
          <div class="form-group">
            <label for="voucher-phone">Số lượng</label>
            <input type="number" max="7" min="1" value="1" class="form-control" id="voucher-total" name="total">
          </div>
          
          <div class="form-group">
            <label for="voucher-note">Ghi chú</label>
            <textarea class="form-control note" id="voucher-note" rows="3"></textarea>
          </div>
          <div class="form-group submit-voucher">
            <button type="submit" class="btn btn-primary send">Gửi</button>
            <button type="submit" class="btn btn-primary close" data-dismiss="modal">Hủy</button>
            <img class="image-loading" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Floating rays-32.gif" width="20px" style="display: none;">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<?php else: ?>
  <?php 
$array = array('xe-cong-nghe','thoi-trang-suc-khoe','nguon-dia-oc', 'dien-gia-dung', 'am-thuc-tiec', '4-mua-khuyen-mai');
if(in_array($category->slug, $array) && wpmd_is_notdevice()){
  get_template_part('block/block_category_template_cat'); 
}else{
  get_template_part('block/block_category'); 
}
 ?>
<section id="categories" class="categories all-article">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <?php if($category->slug == 'nguon-dia-oc'): ?>
        <div class="real">
          <div class="row">
          <div class="col-md-6">
            <ol class="breadcrumb">
              <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
              <li class="active"><h1 class="title-h1"><?php printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h1></li>
            </ol>
          </div>
          <div class="col-md-6">
<!--            <div class="row">
              <div class="col-md-4">
                <select name="province" id="province" class="form-control">
                  <option value="0">-- Tỉnh/thành phố --</option>
                  <option value="1">Hồ Chí Minh</option>
                </select>
              </div>
              <div class="col-md-4">
                <select name="province" id="province" class="form-control">
                  <option value="0">-- Quận/huyện --</option>
                  <option value="1">Quận 1</option>
                  <option value="1">Quận 2</option>
                  <option value="1">Quận 3</option>
                </select>
              </div>
              <div class="col-md-4">
                <select name="province" id="province" class="form-control">
                  <option value="0">-- Phường/xã --</option>
                  <option value="1">Quận 1</option>
                  <option value="1">Quận 2</option>
                  <option value="1">Quận 3</option>
                </select>
              </div>
            </div>-->
          </div>
        </div>
        </div>
      <?php else: ?>
        <?php if($category->slug != 'tap-chi-moi'): ?>
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
              <li class="active"><h1 class="title-h1"><?php printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h1></li>
            </ol>
          </div>
        </div>
        <?php endif; ?>
      <?php endif; ?>
      </div>
    </div>
    
    <?php
	wp_reset_postdata();
  
  
  if ( have_posts() ) :
  if($parent->slug === 'tap-chi-moi' || $category->slug == 'tap-chi-moi'): ?>
    <?php getTemplatePart('block/trademark',  null, array('product_cat' => $category->slug)); ?>
    
    <?php 
    $parent_obj = get_category_by_slug('tap-chi-moi');
    if($parent_obj):
    $args = array(
        'orderby'           => 'id',
        'order'             => 'DESC',
        'parent'            => $parent_obj->term_id,
        'taxonomy'          => 'category',
        'hide_empty'        => 0 ,
        'number'    => 6,
      );
    $categories = get_categories( $args );
    endif;
    foreach ($categories as $val){
      if($val->count > 0): ?>
      <?php
      $args = array(
        'post_status'    => 'publish',
        'orderby'  => array( 'meta_value_num' => 'ASC', 'post_date' => 'DESC' ),
        'meta_key'			=> 'kich_thuoc_trang',
        'post_type'      => 'post',
        'category_name'  => $val->slug,
      );
      ?>
    <div class="row"><div class="col-md-12"><div class="title-magazine-news"><?php echo $val->name ?></div></div></div>
      <ul class="row show-post-online-magezine">
        <?php query_posts($args);
          while ( have_posts() ) : the_post();
            $number = get_field('kich_thuoc_trang');
            $num = 3;
            $class = '';
                        $nummobile = 6;
                        if($number == 1){
              $class = 'magazine-couple';
                            $num = 6;
                            $nummobile = 12;
                        }
            if($number == 2){
              $class = 'magazine-single';
                        }

            if($number == '3'){
                $class = 'magazine-1-2 magazine-single-half';
            }
          ?>
          <li class="col-md-<?php echo $num; ?> col-sm-<?php echo $nummobile; ?> col-xs-<?php echo $nummobile; ?> <?php echo $class; ?> show-article">
            <figure>
                    <?php
                      $attachment_id = get_post_thumbnail_id(get_the_ID());
                      $link = wp_get_attachment_link($attachment_id, 'full');
                    echo $link;
                    ?>
            </figure>
        </li>
          <?php endwhile; ?>
          </ul>
    <?php   endif;
    } ?>
    
  
    <?php else: ?>
  
    
    <?php if($category->slug == 'khuyen-mai'){ ?>
    <?php 
    if($language == 'en'){
      header('Location: http://unimedia.vn/vi/khuyen-mai/'); 
    }
    ?>
      <ul class="row sale-category">
        <?php while ( have_posts() ) : the_post();
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
                      echo get_the_post_thumbnail(get_the_ID(), array(320,320), array('title' => get_the_title())); ?>
                    <?php }else{ ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                  <?php	} ?>
              <div class="blur"></div>
            </a>

            <figcaption>
              <p class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                </a>
              </p>
              <?php if(get_field('page_sale')): ?>
              <p class="page_sale"><?php echo get_field('page_sale'); ?></p>
               <?php endif; ?>
              
              
              
              <div class="fs-comment">
                
                <span>Bình chọn:</span>
                <?php //echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
                <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
              </div>
            </figcaption>
        </figure>
        </li>

      <?php endwhile; ?>
      </ul>
      
    <?php } elseif ($category->slug == 'copon') { ?>
      <ul class="row voucher grid">
        <div class="grid-sizer col-md-12"></div>
        <?php while ( have_posts() ) : the_post();
        $vote_type = get_field('type_voucher', get_the_ID());
        $class = '';
        if($vote_type == false){
          $class = 'voucher-width';
          $w = '378';
          $h = '480';
        }else{
          $class = 'voucher-height';
          $w = '378';
          $h = '570';
        }
          ?>
        <li class="col-md-4 col-sm-4 col-xs-6 <?php echo $class; ?> grid-item">
          <figure>
            <a href="<?php the_permalink(); ?>">
              <?php
                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                    if (!empty($attachment_id)) {
                      echo get_the_post_thumbnail(get_the_ID(), array($w,$h), array('title' => get_the_title())); ?>
                    <?php }else{ ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                  <?php	} ?>
              <!--<div class="blur"></div>-->
            </a>
        </figure>
        </li>

      <?php endwhile; ?>
      </ul>

    <?php } else{ ?>
    <?php getTemplatePart('block/trademark',  null, array('product_cat' => $category->slug)); ?>
      <ul class="row">
        <?php
//     var_dump($category->slug);
        $arg_category = array (					 
			'post_status'    => 'publish',		
//			'order'          => 'DESC',
//			'orderby'        => 'date',
            'order'				=> 'DESC',
            'meta_key'			=> 'order_by_list_category',
            'orderby'			=> 'meta_value post_date',
//        
			'post_type'      => 'post',
			'category_name'  => $category->slug,
//			'posts_per_page' => 12,
		);
  $category_the_post_query = new WP_Query( $arg_category ); 
  if($category_the_post_query->have_posts()){
    while ($category_the_post_query->have_posts()){
				$category_the_post_query->the_post();
//    }
//  }
//        while ( have_posts() ) : the_post();
        $adv = get_field('top_category', get_the_ID());
        $advslider = get_field('advertisement_top_category', get_the_ID());
        $temp = false;
        if($adv == true){
          $temp = true;
        }
        if($advslider == true){
          $temp = true;
        }
//        if($temp != true):
          ?>
        <li class="col-md-3 col-sm-3 col-xs-6 show-article">
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
                      echo get_the_post_thumbnail(get_the_ID(), array(360,360), array('title' => get_the_title())); ?>
                    <?php }else{ ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                  <?php	} ?>
              <?php if(get_field('quan')): ?>
              <div class="fs-state-vote"><?php echo get_field('quan'); ?></div>
              <?php endif; ?>
              <div class="blur"></div>
            </a>

            <figcaption>
              <p class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                </a>
              </p>
              <?php if(get_the_excerpt()): ?>    
              <p class="address"><?php echo the_excerpt_max_charlength(24); ?></p>
              <?php endif; ?>
              
              <?php if(get_field('gia') && get_field('dien_tich')): ?>
              <div class="sf-price">
                <p class="price">
                  <strong>Giá:</strong> <br><span><?php echo get_field('gia'); ?></span>
                </p>
                <p class="dien-tich">
                  <strong>Diện tích:</strong><br> <span><?php echo get_field('dien_tich'); ?></span>
                </p>
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
        <?php //endif; ?>
  <?php }}; ?>
      </ul>
      
   <?php }
    
    ?>
    <?php endif; ?>
<?php else: ?>
    <div class="row">
      <div class="col-md-12">Dữ liệu đang cập nhật.</div>
    </div>
    <?php endif; ?>

    <div class="row">
      <div class="paging col-md-12">
      <nav>
        <nav>
          <?php wp_pagenavi() ;  ?>
        </nav>
      </nav>
    </div><!--end pagination-->
    </div>
  </div>
</section>
<?php endif ?>


<?php
get_footer();
