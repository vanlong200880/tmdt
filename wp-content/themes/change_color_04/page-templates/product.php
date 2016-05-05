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
$parentId = get_category_by_slug('voucher-moi');
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
          <div class="img">
            <a href="<?php the_permalink(); ?>">
              <?php
              $attachment_id = get_post_thumbnail_id(get_the_ID());
              if (!empty($attachment_id))
                  echo get_the_post_thumbnail(get_the_ID(), array(376,251), array('title' => get_the_title()));
              ?>
              </a>
          </div>
          <div class="item-content">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="price">
              <p class="sale">
                <?php 
                $sale = get_field('sale', get_the_ID());
                if($sale): ?>
                <?php echo $sale; ?>
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

<!--<div class="modal fade voucher-view" id="voucher-view" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg modal-sm">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="form-voucher-detail">
        
      </div>
    </div>
  </div>
</div>-->

<div class="loading">
  <img src="<?php echo get_template_directory_uri(); ?>/images/Floating rays-32.gif">
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
<div id="my-welcome-message">
           
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/voucher-1.png" alt="" style="width: 100%;">

  </div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.firstVisitPopup.js"></script>
<script type="text/javascript">
            $(function () {
                $('#my-welcome-message').firstVisitPopup({
                    cookieName: 'homepage',
                    showAgainSelector: '#show-message'
                });
                $("#owl-voucher").owlCarousel({
                  items : 1,
                  itemsDesktop: [1400, 1],
                  itemsDesktopSmall: [1100, 1],
                  itemsTablet: [767, 1],
                  itemsMobile: [500, 1],
                  autoPlay: 4000,
                  navigation : true,
                  slideSpeed : 300,
                  paginationSpeed : 400,
                  pagination : false,
                  paginationNumbers: false,
                      //singleItem : true,
                  navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                  rewindNav : true,
                  stopOnHover : true
              });
            });
</script>
<?php
get_footer();
