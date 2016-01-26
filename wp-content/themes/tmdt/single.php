<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
4 */
global $current_user;
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="categories details all-article">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							 <ol class="breadcrumb">
										<?php if(function_exists('bcn_display'))
										{
												bcn_display();
										}?>
								</ol>
						</div>	
					</div>
					<div class="row">
						<div class="col-md-9 col-sm-8 col-xs-12 content-details">
							<div class="info-top-details">
								<div class="row">
									<div class="col-md-6">
                    <?php twentyfourteen_post_thumbnail(); ?>
									</div>
									<div class="col-md-6 show-info-dt">
                    <?php  $category = get_the_category(get_the_ID()); ?>
                    <h5><?php the_title(); ?>
                    <?php if($category[0]->slug == 'khuyen-mai' || $category[0]->slug == 'copon'): ?>
                      <a id="btnPrint"><i class="fa fa-print" title="Print"></i></a>
                        <script type="text/javascript">
                          jQuery(document).ready(function($){
                            $("#btnPrint").on("click", function () {
                            var divContents = $("#dvContainer").html();
                            var printWindow = window.open('', '');
                            printWindow.document.write('<html><head><title><?php the_title(); ?></title>');
                            printWindow.document.write('</head><body >');
                            printWindow.document.write(divContents);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();
                            printWindow.print();
                            printWindow.close();
                          });
                          });
                        </script>
                      <?php endif; ?>
                    </h5>
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
                    <?php
                    if($category[0]->slug == 'am-thuc-tiec'):
                    $result = get_vote(get_the_ID());
                    if($result):
                    ?>
                    <div class="share-voted">
                      <ul>
                        <li>
                          <div id="view-quality" class="number-voted"><?php echo $result['quality'] ?></div>
                          <div class="content-voted">Chất lượng</div>
                        </li>
                        <li>
                          <div id="view-price" class="number-voted"><?php echo $result['price'] ?></div>
                          <div class="content-voted">Giá cả</div>
                        </li>
                        <li>
                          <div id="view-service" class="number-voted"><?php echo $result['service'] ?></div>
                          <div class="content-voted">Phục vụ</div>
                        </li>
                        <li>
                          <div id="view-position" class="number-voted"><?php echo $result['position'] ?></div>
                          <div class="content-voted">Vị trí</div>
                        </li>
                        <li>
                          <div id="view-space" class="number-voted"><?php echo $result['space'] ?></div>
                          <div class="content-voted">Không gian</div>
                        </li>
                        <?php if(is_user_logged_in()): ?>
                        <li>
                          <a data-toggle="modal" data-target=".modal-vote">Đánh giá</a>
                        </li>
                        <?php else: ?>
                        <li>
                          <a data-toggle="modal" data-target="#login-form">Đánh giá</a>
                        </li>
                        <?php endif; ?>
                      </ul>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
										<p class="share-social">
											<div class="share-post">
												<!-- Go to www.addthis.com/dashboard to customize your tools -->
												<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50dd5241008a00cc" async="async"></script>
												<!-- Go to www.addthis.com/dashboard to customize your tools -->
												<div class="addthis_sharing_toolbox"></div>
											</div>
										</p>
                    
                    
                    
                    
                    
                    
                    <?php
                    if($category[0]->slug == 'am-thuc-tiec'):
                    ?>
                    <!-- Small modal -->
                    <div class="modal fade bs-example-modal-sm modal-vote" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="vote_post">
                            <fieldset>
                              <legend>Đánh giá</legend>
                              <form class="form-horizontal" id="voted_form" action="voted_form">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $current_user->ID; ?>">
                                <input type="hidden" id="post_id" name="post_id" value="<?php echo get_the_ID(); ?>">
                                <div class="vote-message"></div>
                                <div class="post-vote-item">
                                  <div class="col-sm-12">
                                    <label class="control-label">Vị trí tốt:</label>
                                    <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
                                    <span id="ex1SliderVal">5</span>
                                  </div>
                                </div>
                                <div class="post-vote-item">
                                  <div class="col-sm-12">
                                    <label class="control-label">Giá cả:</label>
                                    <input id="ex2" data-slider-id='ex2Slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
                                    <span id="ex2SliderVal">5</span>
                                  </div>
                                </div>

                                <div class="post-vote-item">
                                  <div class="col-sm-12">
                                    <label class="control-label">Chất lượng:</label>
                                    <input id="ex3" data-slider-id='ex3Slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
                                    <span id="ex3SliderVal">5</span>
                                  </div>
                                </div>

                                <div class="post-vote-item">
                                  <div class="col-sm-12">
                                    <label class="control-label">Phục vụ:</label>
                                    <input id="ex4" data-slider-id='ex4Slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
                                    <span id="ex4SliderVal">5</span>
                                  </div>
                                </div>

                                <div class="post-vote-item">
                                  <div class="col-sm-12">
                                    <label class="control-label">Không gian:</label>
                                    <input id="ex5" data-slider-id='ex5Slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
                                    <span id="ex5SliderVal">5</span>
                                  </div>
                                </div>

                                <div class="post-vote-item">
                                    <label class="control-label">&nbsp;</label>
                                    <button type="submit" id="submit-vote" class="btn btn-default">Đánh giá</button>
                                </div>
                              </form>
                            </fieldset>
                          </div>
                        </div>
                      </div>
                    </div>
                    
										<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-slider.css">
										<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-slider.js"></script>
										<script type="text/javascript">
											jQuery(document).ready(function($){
                          var slider = new Slider("#ex1",{
                            tooltip: 'hide',
                            formatter: function(value) {
                              return value;
													}});
                          $("#ex1").on("slide", function(slideEvt) {
                            $("#ex1SliderVal").text(slideEvt.value);
                          });
                          slider.on("slide", function(slideEvt) {
                            $("#ex1SliderVal").text(slideEvt.value);
                          });
                          
                          var slider = new Slider("#ex2",{
                            tooltip: 'hide',
                            formatter: function(value) {
                              return value;
													}});
                          $("#ex2").on("slide", function(slideEvt) {
                            $("#ex2SliderVal").text(slideEvt.value);
                          });
                          slider.on("slide", function(slideEvt) {
                            $("#ex2SliderVal").text(slideEvt.value);
                          });
                          
                          var slider = new Slider("#ex3",{
                            tooltip: 'hide',
                            formatter: function(value) {
                              return value;
													}});
                          $("#ex3").on("slide", function(slideEvt) {
                            $("#ex3SliderVal").text(slideEvt.value);
                          });
                          slider.on("slide", function(slideEvt) {
                            $("#ex3SliderVal").text(slideEvt.value);
                          });

                          var slider = new Slider("#ex4",{
                            tooltip: 'hide',
                            formatter: function(value) {
                              return value;
													}});
                          $("#ex4").on("slide", function(slideEvt) {
                            $("#ex4SliderVal").text(slideEvt.value);
                          });
                          slider.on("slide", function(slideEvt) {
                            $("#ex4SliderVal").text(slideEvt.value);
                          });
                          
                          var slider = new Slider("#ex5",{
                            tooltip: 'hide',
                            formatter: function(value) {
                              return value;
													}});
                          $("#ex5").on("slide", function(slideEvt) {
                            $("#ex5SliderVal").text(slideEvt.value);
                          });
                          slider.on("slide", function(slideEvt) {
                            $("#ex5SliderVal").text(slideEvt.value);
                          });
											});
										</script>
                    <?php endif; ?>
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
                      <div id="dvContainer">
                      <?php the_content(); ?>
                      </div>
											<p>Người đăng: 
                        <?php
                          if ( 'post' == get_post_type() )
                            echo get_the_author(); ?>
											</p>
										</div>
										
									</div><!--end info-->
									<div role="tabpanel" class="tab-pane" id="map1">
                    <?php
                        $address = get_field('address');
                        if(!empty($address)){
                        $data_arr = geocode($address);
                        if($data_arr){

                              $latitude = $data_arr[0];
                              $longitude = $data_arr[1];
                              $formatted_address = $data_arr[2];
                        ?>
                        <div class="load-map">
                          <div id="gmap_canvas" style="width: 100%; height: 600px;">Loading map...</div>
                        </div>
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
                    
                    <?php } else{
                            echo "No map found.";
                        }
                      }
                    ?>
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
                        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1624371511157699";
                        fjs.parentNode.insertBefore(js, fjs);
                      }(document, 'script', 'facebook-jssdk'));</script>
                      <div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" data-width="100%" data-numposts="5"></div>
										</div>
									</div><!--end info-->
								</div><!--end tab-content-->

							</div><!--end tab-content-details-->
						</div><!--end content-details-->
						<div id="sidebar" class="col-md-3 col-sm-4 col-xs-12">
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
                $col = '';
                $row = '';
                if(wpmd_is_phone()){
                  $col = 'col-xs-6';
                  $row = 'row';
                }
                if(wpmd_is_tablet()){
                  $col = 'col-sm-4';
                  $row = 'row';
                }
                $featured_the_query = new WP_Query( $featured ); 
                if($featured_the_query){ ?>
								<div class="title-details">
									<h2>
										<span class="fa fa-newspaper-o"></span>
										Bài liên quan
									</h2>
								</div>
              <div class="post-related <?php echo $row; ?>">
								<?php	while ($featured_the_query->have_posts()){
                        $featured_the_query->the_post(); ?>
								<div class="show-article-details <?php echo $col; ?>">
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
											<p>
												<span>Bình chọn:</span>
												<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
											</p>
										</figcaption>
									</figure>
								</div>
									<?php } ?>
                </div>
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
