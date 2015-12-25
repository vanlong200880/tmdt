<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="search all-article">
	<div class="container">
		<div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo get_site_url() ?>">Trang chủ</a></li>
          <li class="active">Tìm kiếm</li>
        </ol>
      </div>
    </div>
		<div class="row">
<?php
wp_reset_postdata();
$keyword = $_GET['s'];
if(!empty($keyword)){
	$data = getListCategory('news');
	$slug = '';
	foreach ($data as $dataSearch){
		$format = html_entity_decode($dataSearch->name);
		if($keyword == $format){
			$slug = $dataSearch->slug;
		}
	}
	$category = get_category_by_slug($slug);
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$args = array(
			'post_status'    => 'publish',		
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_type'      => 'post'
		);
	if(!empty($slug) && !empty($category)){
		// tim theo danh muc
		$args['category_name'] = $slug;
		
	}else{
		// tim tong the.
		$slug = 'xe-cong-nghe';
		$args['category_name'] = 'news';
		$args['s'] = $keyword;
	}
	
	$args['posts_per_page'] = 3;
	$args['paged'] = $paged;
	
	
	$my_the_query = new WP_Query( $args );
  if($my_the_query->have_posts()): ?>
		<div class="col-md-8 show-search">
			<ul class="row">
		<?php while ($my_the_query->have_posts()){
			$my_the_query->the_post(); ?>
				<li class="col-md-6">
					<div class="show-article-details">
						<figure>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php 
											$attachment_id = get_post_thumbnail_id(get_the_ID());
											if (!empty($attachment_id)) { 
												the_post_thumbnail(array(178,118)); ?>
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
								<?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
								<p>
									<span>Bình chọn:</span>
									<?php echo do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]'); ?>
								</p>
								<p class="review">
									Bình luận: <span>23.000</span>
								</p>
							</figcaption>
						</figure>
					</div>
				</li>
		<?php } ?>
			</ul>
			<div class="row">
			<div class="paging col-md-12">
					<?php	 wp_pagenavi(array('query' => $my_the_query )) ;
					?>
					
			</div>
		</div>
		</div>
			<div class="col-md-4">
				<div id="map" style="height: 390px;"></div>
				<script>
					
					function initMap() {
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 14,
							center: {lat: 10.7596132, lng: 106.6644058}
						});

						setMarkers(map);
						
						var infowindow = new google.maps.InfoWindow;
					infowindow.setContent('<b>القاهرة</b>');

					var marker = new google.maps.Marker({map: map, position: {lat: 10.7596132, lng: 106.6644058}});
					marker.addListener('click', function() {
						infowindow.open(map, marker);
					});
					
//						 google.maps.event.addListener(map, 'click', function(e) {
//								placeMarker(e.latLng, map);
//							});
//
//							function placeMarker(position, map) {
//								var marker = new google.maps.Marker({
//									position: position,
//									map: map
//								});  
//								map.panTo(position);
//							}
					}
//					marker.addListener('click', function() {
//						map.setZoom(8);
//						map.setCenter(marker.getPosition());
//					});
					
//					marker = new google.maps.Marker({
//						map: map,
//						draggable: true,
//						animation: google.maps.Animation.DROP,
//						position: {lat: 10.7596132, lng: 106.6644058}
//					});
//					marker.addListener('click', toggleBounce);

					// Data for the markers consisting of a name, a LatLng and a zIndex for the
					// order in which these markers should display on top of each other.
					var beaches = [
						['Bondi Beach', 10.7596132, 106.6644058, 4],
						['Coogee Beach', 10.7569555, 106.6574975, 5],
						['Cronulla Beach', 10.7824952, 106.6641063, 3],
						['Manly Beach', 10.7953893, 106.6443262, 2],
						['Maroubra Beach', 10.7869812, 106.6693443, 1]
					];

//					function toggleBounce() {
//						if (marker.getAnimation() !== null) {
//							marker.setAnimation(null);
//						} else {
//							marker.setAnimation(google.maps.Animation.BOUNCE);
//						}
//					}
//					
//					
					function setMarkers(map) {
						// Adds markers to the map.

						// Marker sizes are expressed as a Size of X,Y where the origin of the image
						// (0,0) is located in the top left of the image.

						// Origins, anchor positions and coordinates of the marker increase in the X
						// direction to the right and in the Y direction down.
						var image = {
							url: 'images/beachflag.png',
							// This marker is 20 pixels wide by 32 pixels high.
							size: new google.maps.Size(20, 32),
							// The origin for this image is (0, 0).
							origin: new google.maps.Point(0, 0),
							// The anchor for this image is the base of the flagpole at (0, 32).
							anchor: new google.maps.Point(0, 32)
						};
						// Shapes define the clickable region of the icon. The type defines an HTML
						// <area> element 'poly' which traces out a polygon as a series of X,Y points.
						// The final coordinate closes the poly by connecting to the first coordinate.
						var shape = {
							coords: [1, 1, 1, 20, 18, 20, 18, 1],
							type: 'poly'
						};
						
						
//						var infowindow = new google.maps.InfoWindow;
//					infowindow.setContent('<b>237/92A Trần Văn Đang, phường 11, Thành phố Hồ Chí Minh, Quận 3, Ho Chi Minh, Vietnam</b>');
//
//					var marker = new google.maps.Marker({map: map, position: cairo});
//					marker.addListener('click', function() {
//						infowindow.open(map, marker);
//					});
//					
//					
						for (var i = 0; i < beaches.length; i++) {
							var beach = beaches[i];
							var marker = new google.maps.Marker({
								position: {lat: beach[1], lng: beach[2]},
								map: map,
					//      icon: image,
								shape: shape,
								title: beach[0],
								zIndex: beach[3],
							});
						}
					}

							</script>
							<script async defer
									src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDig37w0D8HPxteA9wKJCRtjMI2DuZNCWQ&signed_in=true&callback=initMap"></script>

				
			</div>
			
	<?php endif;
}else{ 
	// khong co ket qua. ?>
			<div class="col-md-8 show-search">Không tìm thấy kết quả nào.</div>
<?php }
?>
		</div>
	</div>
</section>

<?php
get_footer();
