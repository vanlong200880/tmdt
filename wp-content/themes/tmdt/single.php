<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="categories details all-article">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="#">Trang chủ</a></li>
								<li class="active">Ẩm thực & Tiệc</li>
							</ol>	
						</div>	
					</div>

					<div class="row">
						<div class="col-md-9 content-details">
							<div class="info-top-details">
								<div class="row">
									<div class="col-md-6">
                    <?php twentyfourteen_post_thumbnail(); ?>
									</div>
									<div class="col-md-6 show-info-dt">
                    <h5><?php the_title(); ?></h5>
										<p>
                      <span>Chuyên mục:</span>
                      <?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
                      <span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
                      <?php endif; ?>
                    </p>
                    <?php if(get_field('address')): ?>
										<p>
											<span class="fa fa-map-marker"></span>
											<?php echo get_field('address'); ?>
										</p>
                    <?php endif; ?>
                    <?php if(get_field('phone')): ?>
										<p>
											<span class="fa fa-phone"></span>
											<?php echo get_field('phone'); ?>
										</p>
                    <?php endif; ?>
                    <?php if(get_field('url') && get_field('url') != 'http://' && get_field('url') != 'shttp://' ): ?>
										<p>
											<span class="fa fa-link"></span>
                      <a href="<?php echo get_field('url'); ?>" target="_blank"><?php echo get_field('url'); ?></a>
										</p>
                    <?php endif; ?>
										<p class="vote-details">
											<span>Bình chọn:</span>
											<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
										</p>
										<p class="share-social">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/share-social.png" alt="">
										</p>
										
									</div>
								</div>
							</div><!--end info-top-details-->

							<div class="tab-content-details">
								<!-- Nav tabs -->
							   <ul class="nav nav-tabs" role="tablist">
							      <li class="active"><a href="#info" aria-controls="info" data-toggle="tab">Thông tin</a></li>
							      <li><span>|</span></li>
							      <li><a href="#map1" aria-controls="map1" data-toggle="tab">Bản đồ</a></li>
							      <li><span>|</span></li>
							      <li><a href="#comment" aria-controls="comment" data-toggle="tab">Bình luận</a></li>
							   </ul>
							   <!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="info">
										<div class="show-dt-editor">
                      <?php the_content(); ?>
											<p>Người đăng: 
                        <?php
                          if ( 'post' == get_post_type() )
                            echo get_the_author(); ?>
											</p>
										</div>
										
									</div><!--end info-->
									<div role="tabpanel" class="tab-pane" id="map1">
										<div class="load-map">
                      <?php
                          $address = get_field('address');
                          if(!empty($address)){
                            

                          $data_arr = geocode($address);
                          if($data_arr){

                                $latitude = $data_arr[0];
                                $longitude = $data_arr[1];
                                $formatted_address = $data_arr[2];
                          ?>
                      <div id="gmap_canvas" style="width: 100%; height: 600px;">Loading map...</div>
                      <?php } else{
                              echo "No map found.";
                          }
                        }
                      ?>
											<!--<img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/map-1.jpg" alt="">-->
										</div>
									</div><!--end info-->
									<div role="tabpanel" class="tab-pane" id="comment">
										<div class="vote-top">
											<h5>Bình chọn của bạn</h5>
											<div class="ct-vote">
                        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
												<!--<img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/vote-dt.png" alt="">-->
											</div>
										</div>
										<div class="ipicomments">
                      <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-comments" data-href="http://developers.facebook.com/docs/plugins/comments/" data-width="100%" data-numposts="5"></div>
										</div>
									</div><!--end info-->
								</div><!--end tab-content-->

							</div><!--end tab-content-details-->
							
								<div class="share-post">
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
									<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50dd5241008a00cc" async="async"></script>
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
									<div class="addthis_sharing_toolbox"></div>
							</div>

						</div><!--end content-details-->
						<div id="sidebar" class="col-md-3">
							<?php
							global $post;

								$category = get_the_category($post->ID);
                $featured = array (					 
                    'post_status'    => 'publish',		
                    'order'          => 'DESC',
                    'orderby'        => 'date',
                    'post_type'      => 'post',
                    'category_name'  => $category[0]->slug,
										'posts_per_page' => 5,
                    'post__not_in'   => array(get_the_ID())
                );
                $featured_the_query = new WP_Query( $featured ); 
                if($featured_the_query){ ?>
								<div class="title-details">
									<h2>
										<span class="fa fa-newspaper-o"></span>
										Bài liên quan
									</h2>
								</div>
								<?php	while ($featured_the_query->have_posts()){
                        $featured_the_query->the_post(); ?>
								<div class="show-article-details">
									<figure>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<?php 
											$attachment_id = get_post_thumbnail_id(get_the_ID());
											if (!empty($attachment_id)) { 
												the_post_thumbnail(array(188, 122)); ?>
											<?php }else{ ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
										<?php	} ?>
												<div class="blur"></div>
											</a>
										<figcaption>
											<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
											<?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
											<p>
												<span>Bình chọn:</span>
												<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
											</p>
										</figcaption>
									</figure>
								</div>
									<?php } ?>
								<?php }
?>
							<div class="adv-details">
								<?php echo adrotate_ad(10); ?>
							</div>

						</div>
					</div>

				</div>
			</section>
<?php endwhile; ?>

<?php
get_footer(); ?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>    
<script type="text/javascript">
jQuery(document).ready(function(){
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		e.target
		e.relatedTarget
		init_map();
	})
	function init_map() {
        var myOptions = {
            zoom: 14,
            center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
        marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
        });
        infowindow = new google.maps.InfoWindow({
            content: "<?php echo $formatted_address; ?>"
        });
        google.maps.event.addListener(marker, "click", function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
    }
    google.maps.event.addDomListener(window, 'load', init_map);
});
    
</script>
