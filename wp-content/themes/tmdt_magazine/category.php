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
if($parent->slug =='danh-muc-coupon'): ?>
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
?>
<div class="coupon-slider">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/banner-desktop-v2.jpg">
    </div>
  </div>
</div>
</div>
<?php 
$parentId = get_category_by_slug('danh-muc-coupon');
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
      <ul>
        <?php 
        foreach ($cats as $value){ ?>
        <?php $active = '';
// var_dump($value);
            if($value->slug == $category->slug){
              $active = 'active';
            } ?>
        <li class="item-coupon-list-<?php echo $value->term_id; ?> <?php echo $active; ?>">
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
        <h1>Hàng ngàn coupon giá rẻ bất ngờ</h1>
      </div>
    </div>
  </div>
</div>

<div class="breadcrumb-coupon">
  <div class="container">
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
            <h2><a href="#"><?php the_title(); ?></a></h2>
            <div class="price">
              <?php echo get_field('url', get_the_ID()); ?>
              
              <p class="sale">
                <?php 
                $sale = get_field('sale', get_the_ID());
                if($sale): ?>
                -<?php echo $sale; ?>%
                <?php endif; ?>
              </p>
              <p>
<!--                <span class="line">500,000đ</span>
                <span>500,000đ</span>-->
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
            <input type="number" max="10" min="1" value="1" class="form-control" id="voucher-total" name="total">
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
        <ol class="breadcrumb">
          <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
          <li class="active"><?php printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></li>
        </ol>
      </div>
    </div>
    
    <?php
	wp_reset_postdata();
  
  
  if ( have_posts() ) :
  if($parent->slug === 'tap-chi-moi'): ?>
    <ul class="row show-post-online-magezine">
    <?php 
    $args = array(
      'post_status'    => 'publish',
      'orderby'  => array( 'meta_value_num' => 'ASC', 'post_date' => 'DESC' ),
      'meta_key'			=> 'kich_thuoc_trang',
      'post_type'      => 'post',
      'category_name'  => $category->slug,
  );
  query_posts($args);
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
    <?php else: ?>
  
    
    <?php if($category->slug == 'khuyen-mai'){ ?>
      <ul class="row">
        <?php while ( have_posts() ) : the_post();
          ?>
        <li class="col-md-2 col-sm-2 col-xs-6 show-article">
          <figure>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php 
                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                    if (!empty($attachment_id)) { 
                      the_post_thumbnail(array(183,122)); ?>
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
              <p class="address"><?php echo the_excerpt_max_charlength(20); ?></p>
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
                      the_post_thumbnail(array($w,$h)); ?>
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
      <ul class="row">
        <?php
        while ( have_posts() ) : the_post();
        $adv = get_field('top_category', get_the_ID());
        $advslider = get_field('advertisement_top_category', get_the_ID());
        $temp = false;
        if($adv == true){
          $temp = true;
        }
        if($advslider == true){
          $temp = true;
        }
        if($temp != true):
          ?>
        <li class="col-md-2 col-sm-2 col-xs-6 show-article">
          <figure>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php
                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                    if (!empty($attachment_id)) { 
                      the_post_thumbnail(array(183,122)); ?>
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
              <p class="address"><?php echo the_excerpt_max_charlength(12); ?></p>
              <p>
                <span>Bình chọn:</span>
                <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
              </p>
            </figcaption>
        </figure>
        </li>
        <?php endif; ?>
      <?php endwhile; ?>
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
