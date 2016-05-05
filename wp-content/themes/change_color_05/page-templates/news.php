<?php
/**
 * Template Name: Tin mới
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
          <li class="active"><h1 class="title-h1">Tin mới</h1></li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
          wp_reset_postdata();
          $paged = get_query_var('paged') ? get_query_var('paged') : 1;
          $args = array (					 
                  'post_status'    => 'publish',		
                  'order'				=> 'DESC',
                  'orderby'			=> 'post_date',
                  'post_type'      => 'post',
                  'category_name'  => 'tin-moi',
                  'paged'          => $paged,
                  'posts_per_page' => 60,
              );

              $the_query = new WP_Query( $args ); 
              if($the_query->have_posts()): ?>
              <ul class="row">
                  <?php while ($the_query->have_posts()){
                      $the_query->the_post();
                      ?>
            <li class="col-md-4 col-sm-4 col-xs-6 show-article">
              <div class="item-news">
                <div class="title">
                  
                </div>
                <a target="_blank" class="img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php 
                                          $attachment_id = get_post_thumbnail_id(get_the_ID());
                                          if (!empty($attachment_id)) { 
                                              echo get_the_post_thumbnail(get_the_ID(), array(120,120), array('title' => get_the_title())); ?>
                                          <?php }else{ ?>
                                          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                                      <?php	} ?>
                  <div class="blur"></div>
                </a>
                <h2><a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                      <?php the_title(); ?>
                    </a></h2>
                <p><?php echo the_excerpt_max_charlength(50); ?></p>
                
              </div>
            </li>
              <?php	} ?>
              </ul>
        <?php else: ?>
        <div class="row">
          <div class="col-md-12">Dữ liệu đang cập nhật.</div>
        </div>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="row">
      <div class="paging col-md-12">
      <nav>
        <nav>
          <?php  wp_pagenavi(array( 'query' => $the_query)) ;  ?>
        </nav>
      </nav>
    </div>
    </div>
    

  </div>
</section>

<?php
get_footer();