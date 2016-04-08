<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
4 */
global $post;
$category = get_the_category($post->ID);
$parent = get_category($category[0]->category_parent);
global $current_user;
if($parent->slug == 'tap-chi-online'): ?>
<?php while ( have_posts() ) : the_post(); 
        $listGalery = getGaleryFromPost($post);
        if($listGalery[0]){ ?>

		<?php if(wpmd_is_notdevice() == true): ?>
		<!-- is tablet and desktop -->
		
		<!doctype html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
   
    <!-- viewport -->
    <meta content="width=device-width,initial-scale=1" name="viewport">
       
    <!-- title -->
    <title><?php the_title() ?></title>        
        
    <!-- add css and js for flipbook -->
    <link type="text/css" href="<?php echo get_template_directory_uri() ?>/slipbook/css/style.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Play:400,700">
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/jquery.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/turn.js"></script>              
	<script src="<?php echo get_template_directory_uri() ?>/slipbook/js/jquery.fullscreen.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/jquery.address-1.6.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/wait.js"></script>
	<script src="<?php echo get_template_directory_uri() ?>/slipbook/js/onload.js"></script>


    <!-- style css  -->
	<style>	
	    html,body {
          margin: 0;
          padding: 0;
		  overflow:auto !important;
        }
	</style>
	</head>
 
<body>



 
<!-- DIV YOUR WEBSITE --> 
<div style="width:100%;margin:0 auto">
<!-- BEGIN FLIPBOOK STRUCTURE -->  
<div id="fb5-ajax">	
      <!-- BEGIN HTML BOOK -->      
      <div data-current="magazine" class="fb5" id="fb5">     
		  <!-- PRELOADER -->
            <div class="fb5-preloader">
            <div id="wBall_1" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_2" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_3" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_4" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_5" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            </div>      
      
            <!-- BACK BUTTON -->
            <a href="#" id="fb5-button-back"><?php echo ($language =='vi') ?'Đóng' : 'Close'; ?></a>
			
			
            <!-- BACKGROUND FOR BOOK -->  
            <div class="fb5-bcg-book"></div>                      
            <!-- BEGIN CONTAINER BOOK -->
            <div id="fb5-container-book">
                <!-- BEGIN deep linking -->  
                <section id="fb5-deeplinking">
                     <ul>
                        <?php 
                            foreach ($listGalery[0]['ids'] as $k => $galery) { 
                                $k++;
                                //if($k > 0){
?>
                          <li data-address="page<?php echo $k ?>" data-page="<?php echo $k; ?>"></li>
                                <?php } //} ?>
                          <?php if(count($listGalery[0]['ids'])%2 != 0): ?>
                          <li data-address="page<?php echo count($listGalery[0]['ids'])+1 ?>" data-page="<?php echo count($listGalery[0]['ids'])+1; ?>"></li>
                          <?php endif; ?>
                     </ul>
                 </section>
                <!-- END deep linking -->  
                <!-- BEGIN ABOUT -->
<!--                <section id="fb5-about">
                    <?php 
//                        foreach ($listGalery[0]['ids'] as $k => $galery) {
//                            if($k === 0){
//                                the_post_thumbnail(array(480, 635), array('id'    => 'id_'.$galery, 'alt' => trim(strip_tags(get_post_meta($galery, '_wp_attachment_image_alt', true))),));
//                            }
                            ?>
                   <?php //} ?>
                </section>-->
                <!-- END ABOUT -->
                <!-- BEGIN BOOK -->
                <div id="fb5-book">
                <!-- BEGIN PAGE 1 -->
                <?php 
                        foreach ($listGalery[0]['ids'] as $k => $galery) {
                            //if($k > 0){ ?>
                        <div data-background-image="<?php echo wp_get_attachment_url($galery); ?>" class="">
                             
                        </div>
                            <?php } //} ?>
                
                        <?php if(count($listGalery[0]['ids'])%2 != 0): ?>
                          <div data-background-image="none" class="">
                             
                        </div>
                          <?php endif; ?>
                <!-- END PAGE 1 -->                          
              </div>
              <!-- END BOOK -->
              <!-- arrows -->
              <a class="fb5-nav-arrow prev"></a>
              <a class="fb5-nav-arrow next"></a>
             </div>
             <!-- END CONTAINER BOOK -->
        <!-- BEGIN FOOTER -->
        <div id="fb5-footer">
            <div class="fb5-bcg-tools"></div>
            <a id="fb5-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="100" alt="<?php echo get_bloginfo('title'); ?>">
            </a>
            <div class="fb5-menu" id="fb5-center">
                <ul>                                        
                    <!-- icon_zoom_in -->                              
                    <li>
                        <a title="ZOOM IN" class="fb5-zoom-in"></a>
                    </li>                               
                    <!-- icon_zoom_out -->
                    <li>
                        <a title="ZOOM OUT " class="fb5-zoom-out"></a>
                    </li>                                
                    <!-- icon_zoom_auto -->
<!--                    <li>
                        <a title="ZOOM AUTO " class="fb5-zoom-auto"></a>
                    </li>                                -->
                    <!-- icon_zoom_original -->
<!--                    <li>
                        <a title="ZOOM ORIGINAL (SCALE 1:1)" class="fb5-zoom-original"></a>
                    </li>-->
                    <!-- icon_allpages -->
                    <li>
                        <a title="SHOW ALL PAGES " class="fb5-show-all"></a>
                    </li>
                    <!-- icon_home -->
                    <li>
                        <a title="SHOW HOME PAGE " class="fb5-home"></a>
                    </li>              
                </ul>
            </div>
            <div class="fb5-menu" id="fb5-right">
                <ul> 
                    <!-- icon page manager -->                 
                    <li class="fb5-goto">
                        <label for="fb5-page-number" id="fb5-label-page-number">PAGE</label>
                        <input type="text" id="fb5-page-number">
                        <button type="button">GO</button>
                    </li>        
                    <!-- icon fullscreen -->                 
                    <li>
                        <a title="FULL / NORMAL SCREEN" class="fb5-fullscreen"></a>
                    </li>                                                      
                </ul>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN ALL PAGES -->
          <div id="fb5-all-pages" class="fb5-overlay">
          <section class="fb5-container-pages">
            <div id="fb5-menu-holder">
                <ul id="fb5-slider">
                        <?php 
                        foreach ($listGalery[0]['ids'] as $k => $galery) {
                            //if($k > 0){ ?>
                    
                            <li class="<?php echo $k; ?>">
                                <img alt="" data-src="<?php echo wp_get_attachment_url($galery, array(120,170)); ?>">
                            </li>
                            <?php } //} ?>
                            
                  </ul>
              </div>
          </section>
         </div>

         <!-- END ALL PAGES -->
   </div>
   <!-- END HTML BOOK -->
    <!-- CONFIGURATION FLIPBOOK -->
    <script>    
    jQuery('#fb5').data('config',
    {
    "page_width":"450",
    "page_height":"635",
	"email_form":"vanlong200880@gmail.com",
    "zoom_double_click":"1",
    "zoom_step":"0.3",
    "double_click_enabled":"true",
    "tooltip_visible":"true",
    "toolbar_visible":"true",
    "gotopage_width":"30",
    "deeplinking_enabled":"true",
    "rtl":"false",
    'full_area':'true',
	'lazy_loading_thumbs':'true',
	'lazy_loading_pages':'true'
    })
	
	jQuery(document).ready(function($){
		$("#fb5-button-back").on('click', function(){
			window.close();
		});
	});
    </script>
</div>
<!-- END FLIPBOOK STRUCTURE -->    
</div> 
<!-- END DIV YOUR WEBSITE --> 
</body>
</html>

		
		
		
		<?php else: ?>
		<!-- is mobile -->

<?php	 get_header() ?>

 <?php 
					$arrJson = array();
                        foreach ($listGalery[0]['ids'] as $k => $galery) {
								$uploads = wp_upload_dir();
								$upload_path = $uploads['baseurl'];
								$img = wp_get_attachment_metadata($galery);
								$arrJson[] = array(
								  'src' => $upload_path.'/'.$img['file'],
								  'w' => $img['width'],
								  'h' => $img['height'],
								);
						}
					?>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
     
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button id="photoswipeclose" class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
          </div>
        </div>
</div>
 
<script type="text/javascript">
	var openPhotoSwipe = function() {
    var pswpElement = document.querySelectorAll('.pswp')[0];
	var items = <?php echo json_encode($arrJson); ?>
    
    // define options (if needed)
    var options = {    
        history: false,
        focus: false,
        showAnimationDuration: 0,
        hideAnimationDuration: 0,
		preloaderEl: true
    };
    
    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
	gallery.listen('close', function() {
		window.close();
	});
};
openPhotoSwipe();
</script>
<?php get_footer() ?>
		<?php endif; ?>
		<?php } ?>
		<?php endwhile; ?>
<!-- check photo book -->




<?php else: ?>
<?php
get_header(); 
get_template_part('block/block_category'); 
?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="categories details all-article page-single">
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
                                      <?php
                                          $attachment_id = get_post_thumbnail_id(get_the_ID());
                                          $link = wp_get_attachment_link($attachment_id, 'full');
                                          echo $link;
                                      ?>
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
                                        <div class="task-vot">
                                          <p class="vote-details">
                                            <span>Bình chọn:</span><br>
                                              <?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
                                          </p>
                                          <p class="share-social">
											<div class="share-post">
												<!-- Go to www.addthis.com/dashboard to customize your tools -->
												<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50dd5241008a00cc" async="async"></script>
												<!-- Go to www.addthis.com/dashboard to customize your tools -->
												<div class="addthis_sharing_toolbox"></div>
											</div>
										</p>
                                        </div>
                                        
                                          <?php if(get_field('gia') && get_field('dien_tich')): ?>
                                        <div class="price-task">
                                          <p class="vote-details">
                                            Giá: <span class="detail-price"><?php echo get_field('gia'); ?></span>
                                          </p>
                                          <p class="vote-details">
                                            Diện tích: <var><?php echo get_field('dien_tich') ?>m</var><span class="detail-acreage">2</span>
                                          </p>
                                          </div>
                                          <?php endif; ?>
                                        
                                        <?php if(get_the_excerpt()): ?>
                                        <div class="description-single">
                                          <strong>Điểm nổi bật:</strong><br>
                                          <?php echo the_excerpt_max_charlength(20); ?>
                                          </div>
                                          <?php endif; ?>
                                        
										
                    <?php
                    if($category[0]->slug == 'am-thuc-tiec'):
                    $result = get_vote(get_the_ID());
                    if($result):
                    ?>
                    <div class="share-voted share-voted-comment">
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
                                          
<!--											<p>Người đăng: 
                        <?php
                          //if ( 'post' == get_post_type() )
                            //echo get_the_author(); ?>
											</p>-->
										</div>
                                      
                                      <div class="ipicomments">
                                        <div id="fb-root"></div>
                                        
                                        <div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" data-width="100%" data-numposts="5"></div>
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
                        js.src = "//connect.facebook.net/vi-VN/sdk.js#xfbml=1&version=v2.5&appId=1624371511157699";
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
                                  <?php if(get_field('new')): ?>
                                  <div class="hot-single">New</div>
                                  <?php else: ?>
                                    <?php if(get_field('page_hot')): ?>
                                    <div class="hot-single hot">Hot</div>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                  
                                  
                                  
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
                                            <?php if(get_field('gia')): ?>
                                            <p class="fs-pr">Giá: <var><?php echo get_field('gia'); ?></var></p>
                                            <?php endif; ?>
                                            
                                            <?php if(get_field('dien_tich')): ?>
                                            <p class="fs-pr">Diện tích: <?php echo get_field('dien_tich'); ?>m<span>2</span></p>
                                            <?php endif; ?>
											
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
                  <?php
                  global $current_user;
                  $role = $current_user->roles;
                  if(!empty($role)){
                    if(in_array('manager', $role) || in_array('author', $role) || in_array('administrator', $role)){ ?>
                  <a href="<?php echo home_url() ?>/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=edit">Edit</a>
                   <?php }
                  }
                  ?>
				</div>
			</section>
<?php endwhile; ?>

<?php
get_footer(); ?>
<?php endif; ?>
