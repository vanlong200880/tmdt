<?php
/**
 * Template Name: Hot
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php get_template_part('block/block_category');  ?>
<section id="categories" class="categories all-article page-hot">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
          <li class="active">Bài viết mới nhất</li>
        </ol>
      </div>
    </div>
    <?php
	wp_reset_postdata();
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$args = array (					 
			'post_status'    => 'publish',		
			'order'          => 'DESC',
			'orderby'        => 'menu_order',
			'post_type'      => 'post',
			'category_name'  => 'news',
      'paged'          => $paged,
			'posts_per_page' => 120,
		);
		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()):?>
		<ul class="row">
			<?php while ($the_query->have_posts()){
				$the_query->the_post();
                $category_cat = get_the_category();
                  $class = '';
                  if($category_cat && $category_cat[0]->slug != 'nguon-dia-oc'){
                    $class = 'not-real';
                    $char = 16;
                  }
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
										the_post_thumbnail(array(300,300)); ?>
									<?php }else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
								<?php	} ?>
            <div class="blur"></div>
            <?php if(get_field('quan')): ?>
            <div class="fs-state-vote"><?php echo get_field('quan'); ?></div>
            <?php endif; ?>
          </a>

          <figcaption>
            <p class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </p>
            <?php if(get_the_excerpt()): ?>
            <p class="description <?php echo $class; ?>">
							<?php echo the_excerpt_max_charlength($char); ?>
						</p>
                        <?php endif; ?>
            <?php if(get_field('gia') && get_field('dien_tich')): ?>
            <div class="sf-price">
              <p class="fs-pr">Giá:<var><?php echo get_field('gia'); ?></var></p>
              <p class="fs-pr fs-dt">Diện tích: <?php echo get_field('dien_tich'); ?></p>
            </div>
            <?php endif; ?>
                        <p class="comment">
              <span>Bình chọn:</span>
              <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
            </p>
          </figcaption>
      </figure>
      </li>

		<?php	} ?>
		</ul>
<?php else: ?>
    <div class="row">
      <div class="col-md-12">Dữ liệu đang cập nhật.</div>
    </div>
    <?php endif; ?>

    <div class="row">
      <div class="paging col-md-12">
      <nav>
        <nav>
							<?php  wp_pagenavi(array( 'query' => $the_query)) ;  ?>
        </nav>
      </nav>
    </div><!--end pagination-->
    </div>
  </div>
</section>

<?php
get_footer();
