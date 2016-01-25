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
<?php get_template_part('block/block_category');  ?>
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
  $category = get_queried_object();
		if ( have_posts() ) :?>
    
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
      <ul class="row">
        <?php while ( have_posts() ) : the_post();
          ?>
        <li class="col-md-3 col-sm-3 col-xs-6 show-article">
          <figure>
            <a href="<?php the_permalink(); ?>">
              <?php
                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                    if (!empty($attachment_id)) {
                      the_post_thumbnail(array(380,300)); ?>
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
              <p class="address"><?php echo the_excerpt_max_charlength(12); ?></p>
              <p>
                <span>Bình chọn:</span>
                <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
              </p>
            </figcaption>
        </figure>
        </li>

      <?php endwhile; ?>
      </ul>
      
   <?php }
    
    ?>
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
<?php
get_footer();
