<?php
/**
 * Template Name: tuyển dụng
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<?php get_template_part('block/block_category');  ?>
<section id="categories" class="categories all-article page-weekend">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
          <li class="active"><h1 class="title-h1">Tuyển dụng</h1></li>
        </ol>
      </div>
    </div>
    <div class="row recruitment">
      <?php
          wp_reset_postdata();
          $title = $content = '';
          $paged = get_query_var('paged') ? get_query_var('paged') : 1;
          $args = array (					 
            'post_status'    => 'publish',		
            'order'				=> 'DESC',
            'orderby'			=> 'post_date',
            'post_type'      => 'post',
            'category_name'  => 'tuyen-dung-nhan-su',
            'paged'          => $paged,
            'posts_per_page' => 60,
          );

          $the_query = new WP_Query( $args ); 
          if($the_query->have_posts()):
            $count = 0;
              while ($the_query->have_posts()){
                $the_query->the_post();
                $active = '';
                if($count == 0){
                  $active = 'active';
                }
                $title .= '<li role="presentation" class="'.$active.'"><a href="#recruitment-'.  get_the_ID().'" aria-controls="recruitment-'.  get_the_ID().'" role="tab" data-toggle="tab">'.  get_the_title().'</a></li>';
                $content .= '<div role="tabpanel" class="tab-pane '.$active.'" id="recruitment-'.  get_the_ID().'">'.  get_the_content().'</div>';
                $count++;
              }
            endif; 
                
        ?>
      <div class="col-md-3 col-sm-3 col-xs-4">
        <div class="img-tuyen-dung">
          <img src="<?php echo get_template_directory_uri() ?>/images/tuyen-dung.jpg">
        </div>
        <ul class="nav nav-tabs" role="tablist">
          <?php echo $title; ?>
        </ul>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-8">
        <div class="tab-content">
          <?php echo $content; ?>
        </div>
      </div>
    </div>

  </div>
</section>

<?php
get_footer();