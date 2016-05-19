
<?php 



die;
global $current_user;
$role = $current_user->roles;
if(in_array('manager', $role) || in_array('author', $role) || in_array('administrator', $role)): ?>
<style>
  .list-sitemap a{
    color: #000;
    text-decoration: none;
    display: block;
  }
  .list-sitemap a:hover{
    color: red;
  }
  .list-sitemap a.post-l1{
    font-style: italic;
  }
</style>
<div class="list-sitemap">
<?php
  /**
 * Template Name: List Sitemap
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

  $taxonomy     = 'category';
  $orderby      = 'name';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;
  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty
  );
 $all_categories = get_categories( $args );
 foreach ($all_categories as $cat) {
//   var_dump($cat);
    if($cat->category_parent == 0) {
        $category_id = $cat->term_id;
        $icon = get_field('icon', $cat);
        $link = get_field('link', $cat);
//        var_dump($link);
       // $thumbnail_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
        // get the image URL for parent category
        //$image = wp_get_attachment_url($thumbnail_id);
        // print the IMG HTML for parent category
        echo '<a href=""><strong>'. $cat->name .'</strong></a>';
        
        $args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $sub_cats = get_categories( $args2 );
        if($sub_cats) {
            foreach($sub_cats as $sub_category) {
              $sub_cat_id = $sub_category->term_id;
              echo '<a href="">&nbsp; &nbsp; &nbsp; <strong>'. $sub_category->name.'</strong></a>';
              $args3 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $sub_cat_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
              // get post by category
              $argspost = array (
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'orderby'        => 'menu_order',
                'post_type'      => 'post',
                'category_name'  => $sub_category->slug,
              );
              $the_query_post = new WP_Query( $argspost );
              if($the_query_post->have_posts()){
                while ($the_query_post->have_posts()){
				$the_query_post->the_post();
                  echo '<a target="_blank" href="'.home_url().'/wp-admin/post.php?post='.get_the_ID().'&action=edit">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '. get_the_title().'</a>';
                  echo (get_field('advertisement_slider'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo slider trang chủ</a>':'';
                  echo (get_field('advertisement_top'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo top 3 trang chủ</a>':'';
                  echo (get_field('advertisement_top_category'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo slider top trang danh mục</a>':'';
                  echo (get_field('quang_cao_top_3_trang_khuyen_mai'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo top 3 trang khuyến mãi</a>':'';
                  echo (get_field('quang_cao_slider_trang_khuyen_mai'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo slider trang khuyến mãi</a>':'';
                  echo (get_field('quang_cao_top_3_trang_coupon'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo top 3 trang coupon</a>':'';
                  echo (get_field('quang_cao_slider_trang_coupon'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo slider trang coupon</a>':'';
                  echo (get_field('quang_cao_top_3_trang_tap_chi_moi'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo top 3 trang tạp chí mới</a>':'';
                  echo (get_field('quang_cao_slider_trang_tap_chi_moi'))?'<a class="post-l1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Quảng cáo slider trang tạp chí mới</a>':'';
                }
              }
            }
        }
    }
}
?>
</div>  
<?php endif; ?>