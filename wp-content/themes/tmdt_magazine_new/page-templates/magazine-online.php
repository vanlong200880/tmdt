<?php
/**
 * Template Name: Magazine online
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();
get_template_part('block/block_category');  ?>
<section class="page-magazine">
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="row">
              <?php
                  // Start the Loop.
                  while ( have_posts() ) : the_post(); ?>
               <ol class="breadcrumb">
                          <?php if(function_exists('bcn_display'))
                          {
                                  bcn_display();
                          }?>
                  </ol>
              <?php endwhile; ?>
          </div>
      </div>
      <div class="col-md-12">

<?php 
        $parent_obj = get_category_by_slug('tap-chi-online');
//        var_dump($parent_obj);
        if($parent_obj):
        $args = array(
            'orderby'           => 'id',
            'order'             => 'DESC',
            'parent'            => $parent_obj->term_id,
            'taxonomy'          => 'category',
            'hide_empty'        => 0 ,
            'number'    => 6,
          );
        $categories = get_categories( $args );
        foreach ($categories as $val){ ?>
        <?php if($val->count > 0): ?>
<div class="item-magazine">
  <div class="title-magazine"><?php echo $val->name ?></div>
<?php 
          $data_args = array (                   
            'post_status'    => 'publish',      
            'order'          => 'DESC',
            'orderby'        => 'date',
            'post_type'      => 'post',
            'category_name'  => $val->slug,
            'posts_per_page' => 100,
          );
          $data_the_query = new WP_Query( $data_args ); 
          if($data_the_query->have_posts()){
            ?>
  <ul class="row">
    
  
  <?php
            while ($data_the_query->have_posts()){
              $data_the_query->the_post(); ?>
    <li class="col-md-2 col-sm-3 col-xs-6">
      <figure>
          <a href="<?php the_permalink() ?>" target="_blank" title="<?php echo get_the_title(); ?>">
               <?php
                  $attachment_id = get_post_thumbnail_id(get_the_ID());
                  if (!empty($attachment_id)) { 
                      the_post_thumbnail(array(480, 701));
                      ?>
                  <?php }else{
                      echo '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
                  }
              ?>
          </a>
          <figcaption>
              <p><a target="_blank" href="<?php the_permalink()?>"><?php the_title() ?></a></p>
          </figcaption>
      </figure>
    </li>
          <?php  } ?>
  </ul>
  <?php
            wp_reset_postdata();
          }
          endif;
        } 
        
        ?>
        </div>
        <?php 
        
        endif;
        ?>
        </div>
    </div>
  </div>
</section>
<?php
get_footer();
