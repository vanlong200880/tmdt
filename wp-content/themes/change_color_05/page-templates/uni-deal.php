<?php
/**
 * Template Name: UNI DEAL
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<?php get_template_part('block/block_category');  ?>
<section id="categories" class="categories all-article page-weekend uni-deal">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
          <li class="active"><h1 class="title-h1">UNI DEAL</h1></li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
          wp_reset_postdata();
          $args = array (					 
                  'post_status'    => 'publish',		
                  'order'				=> 'DESC',
                  'meta_key'			=> 'sort_by',
                  'orderby'			=> 'meta_value',
                  'post_type'      => 'post',
                  'category_name'  => 'khuyen-mai-trong-tuan',
                  'posts_per_page' => -1,
              );

              $the_query = new WP_Query( $args ); 
              if($the_query->have_posts()):?>
              <ul class="row">
                  <?php while ($the_query->have_posts()){
                      $the_query->the_post();
                      $start_date = strtotime(get_field('start_date'));
                      $end_date = strtotime(get_field('end_date'));
                      if($start_date <= time() && $end_date >= time()):
                      ?>
            <li class="col-md-2 col-sm-3 col-xs-6 show-article">
              <figure>
                <?php if(get_field('new')): ?>
                <div class="news-icon"><span>New</span></div>
                <?php else: ?>
                  <?php if(get_field('page_hot')): ?>
                  <div class="news-icon hot"><span>Hot</span></div>
                  <?php endif; ?>
                <?php endif; ?>
                  <a target="_blank" href="<?php echo get_field('url'); ?>" title="<?php the_title(); ?>">
                  <?php 
                                          $attachment_id = get_post_thumbnail_id(get_the_ID());
                                          if (!empty($attachment_id)) { 
                                              echo get_the_post_thumbnail(get_the_ID(), array(300,300), array('title' => get_the_title())); ?>
                                          <?php }else{ ?>
                                          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                                      <?php	} ?>
                  <div class="blur"></div>
                </a>

                <figcaption>
                  <p class="title"><a target="_blank" href="<?php echo get_field('url'); ?>" title="<?php the_title(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </p>
                  <div class="description">
                    <div><strong>Ngày bắt đầu:</strong> <?php echo date('d/m/Y',$start_date); ?></div>
                    <div><strong>Ngày kết thúc:</strong><?php echo date('d/m/Y',$end_date); ?></div>
                              </div>

                </figcaption>
            </figure>
            </li>
            <?php endif; ?>
              <?php	} ?>
              </ul>
        <?php endif; ?>
      </div>
      
      <div class="col-md-12">
        <?php 
        wp_reset_postdata();
          $args1 = array (					 
            'post_status'    => 'publish',		
            'order'				=> 'DESC',
            'meta_key'			=> 'sort_by',
            'orderby'			=> 'meta_value',
            'post_type'      => 'post',
            'category_name'  => 'khuyen-mai',
            'posts_per_page' => -1,
        );
        $the_query1 = new WP_Query( $args1 ); 
        ?>
        <?php if($the_query1->have_posts()):?>
          <ul class="row sale-category">
          <?php while ( $the_query1->have_posts() ) : $the_query1->the_post();
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
        <?php endif; ?>
      </div>
    </div>
    
    
    
    
    
    
    
    
    
   

    
  </div>
</section>

<?php
get_footer();