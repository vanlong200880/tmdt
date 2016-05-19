<?php
/**
 * Template Name: Khuyến mãi trong tuần
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
global $language;
get_header(); ?>
<?php get_template_part('block/block_category');  ?>
<section id="categories" class="categories all-article page-weekend">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
          <li class="active"><h1 class="title-h1">Khuyến mãi trong tuần</h1></li>
        </ol>
      </div>
    </div>
    <?php
//     var_dump(getdate());
//    echo date('d/m/Y: h:s:i');
	wp_reset_postdata();
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$args = array (					 
			'post_status'    => 'publish',		
//			'order'          => 'DESC',
//			'orderby'        => 'menu_order',
            'order'				=> 'DESC',
            'meta_key'			=> 'sort_by',
            'orderby'			=> 'meta_value',
			'post_type'      => 'post',
			'category_name'  => 'khuyen-mai-trong-tuan',
      'paged'          => $paged,
			'posts_per_page' => 120,
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