<?php
/**
 * Template Name: Product
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
global $post;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
  'post_status'    => 'publish',
  'order'          => 'DESC',
  'orderby'        => 'date',
  'category_name'  => 'voucher',
  'post_type'      => 'post',
  'paged'          => $paged
);
$color = array('#34495d','#95c11e','#302683', '#009bb4', '#f39200', '#c51a1b');
$my_the_query = new WP_Query( $args );
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
        <li class="item-coupon-list-<?php echo $value->term_id; ?> col-md-2">
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
          <div class="img" data-toggle="modal" data-target="#voucher-view">
            
              <?php
              $attachment_id = get_post_thumbnail_id(get_the_ID());
              if (!empty($attachment_id))
                  the_post_thumbnail(array(376,251));
//                $attachment_id = get_post_thumbnail_id(get_the_ID());
//                $link = wp_get_attachment_link($attachment_id, 'full');
//                echo $link;
              ?>
          </div>
          <div class="item-content">
            <h2 data-toggle="modal" data-target="#voucher-view"><?php the_title(); ?></h2>
            <div class="price">
              <?php //echo get_field('url', get_the_ID()); ?>
              
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
    <?php endif; ?>
  </div>
</div>


<!-- view voucher -->

<div class="modal fade voucher-view" id="voucher-view" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="form-voucher">
        <div class="row">
          <div class="col-md-8">
            <img src="http://unimedia.vn/wp-content/uploads/2016/04/SofaDA.jpg">
          </div>
          <div class="col-md-4">
            <h2>Demo voucher Demo voucher Demo voucher Demo voucher Demo voucher Demo voucher Demo voucher Demo voucher </h2>
            <div class="share"></div>
            <div class="description">
              Cân Sức Khỏe Điện Tử Hình Tròn Bảo Vệ Sức Khỏe – Độ Chính Xác Cao, Tải Trọng Tối Đa 180kg – Giúp Bạn Dễ Dàng Theo Dõi Sức Khỏe Bản Thân Và Gia Đình. Giá 300,000 VNĐ, Còn 159,000 VNĐ, Giảm 47%. Chỉ Có Tại Hotdeal.vn!
            </div>
            <div class="sale"></div>
            <div class="total">100 người đã nhận</div>
          </div>
          
          <div class="col-md-12">
            <h2>Thông tin chi tiết</h2>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Small modal -->

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

<?php
get_footer();
