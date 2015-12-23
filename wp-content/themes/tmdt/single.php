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
                    <!--<img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/real-1.jpg" alt="">-->
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
							      <li><a href="#info" aria-controls="info" data-toggle="tab">Thông tin</a></li>
							      <li><span>|</span></li>
							      <li class="active"><a href="#map" aria-controls="map" data-toggle="tab">Bản đồ</a></li>
							      <li><span>|</span></li>
							      <li><a href="#comment" aria-controls="comment" data-toggle="tab">Bình luận</a></li>
							   </ul>
							   <!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane" id="info">
										<div class="show-dt-editor">
                      <?php the_content(); ?>
											<p>Người đăng: 
                        <?php
                          if ( 'post' == get_post_type() )
                            echo get_the_author(); ?>
											</p>
										</div>
										
									</div><!--end info-->
									<div role="tabpanel" class="tab-pane active" id="map">
										<div class="load-map">
                      <?php
                          $address = get_field('address');
                          if(!empty($address)){
                            function geocode($address){
                              $address = urlencode($address);
                              $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
                              $resp_json = file_get_contents($url);
                              $resp = json_decode($resp_json, true);
                              if($resp['status']=='OK'){
                                  $lati = $resp['results'][0]['geometry']['location']['lat'];
                                  $longi = $resp['results'][0]['geometry']['location']['lng'];
                                  $formatted_address = $resp['results'][0]['formatted_address'];
                                  if($lati && $longi && $formatted_address){
                                      $data_arr = array();            
                                      array_push(
                                          $data_arr, 
                                              $lati, 
                                              $longi, 
                                              $formatted_address
                                          );

                                      return $data_arr;

                                  }else{
                                      return false;
                                  }

                              }else{
                                  return false;
                              }
                          }

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
										<div class="other-location">
											<div class="page-header">
						                        <h2>
						                        	<span class="fa fa-map-marker"></span>
						                        	Địa điểm khác
						                        </h2>
						                    </div>
						                    <ul class="more-location row">
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>
						                    	<li class="col-md-4">
						                    		<span class="fa fa-map-marker"></span>
						                    		<a href="#">Công Ty TNHH Liên Tập</a>
						                    	</li>

						                    </ul>
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

						</div><!--end content-details-->
						<div id="sidebar" class="col-md-3">
							<div class="title-details">
								<h2>
									<span class="fa fa-newspaper-o"></span>
									Bài liên quan
								</h2>
							</div>
							<div class="show-article-details">
								<figure>
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fashion-2.jpg" alt="">
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
										<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
										<p>
											<span>Bình chọn:</span>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vote.png" alt="">
										</p>
									</figcaption>
								</figure>
							</div>

							<div class="show-article-details">
								<figure>
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fashion-2.jpg" alt="">
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
										<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
										<p>
											<span>Bình chọn:</span>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vote.png" alt="">
										</p>
									</figcaption>
								</figure>
							</div>

							<div class="show-article-details">
								<figure>
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fashion-2.jpg" alt="">
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
										<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
										<p>
											<span>Bình chọn:</span>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vote.png" alt="">
										</p>
									</figcaption>
								</figure>
							</div>

							<div class="show-article-details">
								<figure>
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fashion-2.jpg" alt="">
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
										<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
										<p>
											<span>Bình chọn:</span>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vote.png" alt="">
										</p>
									</figcaption>
								</figure>
							</div>

							<div class="show-article-details">
								<figure>
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fashion-2.jpg" alt="">
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
										<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
										<p>
											<span>Bình chọn:</span>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vote.png" alt="">
										</p>
									</figcaption>
								</figure>
							</div>

							<div class="show-article-details">
								<figure>
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fashion-2.jpg" alt="">
										<div class="blur"></div>
									</a>
									<figcaption>
										<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
										<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
										<p>
											<span>Bình chọn:</span>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vote.png" alt="">
										</p>
									</figcaption>
								</figure>
							</div>


							<div class="adv-details">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/banner-right.jpg" alt="">
							</div>

						</div>
					</div>

				</div>
			</section>
<?php endwhile; ?>


<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>    
<script type="text/javascript">
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
</script>

<?php
get_footer();
