<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

//get_header(); ?>

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
				
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDig37w0D8HPxteA9wKJCRtjMI2DuZNCWQ&language=vi"></script>
        <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDig37w0D8HPxteA9wKJCRtjMI2DuZNCWQ"></script>-->
				<script>
          function initialize() 
            {
                // Thông số hiển thị bản đồ
                var mapOptions = {
                    zoom: 17,
                    center: new google.maps.LatLng(10.7596132, 106.6644058),
//                    disableDefaultUI: true,
                    panControl: true,
                    zoomControl: true,
                    scaleControl: true,
                };
 
                // Hiển thị bản đồ
                var map = new google.maps.Map(document.getElementById('map'),mapOptions);
 
                // Thêm 5 marker ngẫu nhiên trên bản đồ
                // Đây là hai thông số southWest và northEast của bản đồ
                var southWest = new google.maps.LatLng(12.771971, 104.244141);
                var northEast = new google.maps.LatLng(10.771971, 106.697845);
                
                // Khởi tạo một bounds của 2 vị trí trên
                var bounds = new google.maps.LatLngBounds(southWest, northEast);
                 
                // Fill bound vào google map
                map.fitBounds(bounds);
                 
                // Khoảng cách giữa các tọa độ northEast và northEast
//                var lngSpan = northEast.lng() - southWest.lng();
//                var latSpan = northEast.lat() - southWest.lat();
                
                // Hình dạng
                var shape = {
                    coords: [1, 1, 1, 20, 18, 20, 18, 1],
                    type: 'poly'
                };
                
                // Icon Image Marker
                var icon1 = 'http://google-maps-icons.googlecode.com/files/hostel2star.png';
                var image = {
                    url: icon1,
                    // Kích cỡ hình
                    size: new google.maps.Size(100, 100),
                    // Gốc cho hình là oo
                    origin: new google.maps.Point(0, 0),
                    // Neo cho hình là 0, 32
                    anchor: new google.maps.Point(100, 100)
                };
                
                // Lặp từ 0 đến 4 để hiển thị 5 marker ngẫu nhiên
                var beaches = [
                  ['Bondi Beach', 10.7596132, 106.6644058, 4],
                  ['Coogee Beach', 10.7569555, 106.6574975, 5],
                  ['Cronulla Beach', 10.7824952, 106.6641063, 3],
                  ['Manly Beach', 10.7953893, 106.6443262, 2],
                  ['Maroubra Beach', 10.7869812, 106.6693443, 1]
                ];

                for (var i = 0; i < beaches.length; i++) {
                  var beach = beaches[i];
                    var position = new google.maps.LatLng(
                            beach[1],
                            beach[2]);
                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        zIndex: beach[3],
//                        shape: shape,
//                        icon: image,
                    });
                     
                    // Thiết lập tiêu đề cho marker
                    marker.setTitle((beach[0]).toString());
                     
                    // Gọi hàm attachSecretMessage để hiển thị message cho từng marker
                    attachSecretMessage(marker,beach[0] , i);
                }
            }
 
            // Thêm message thông báo khi click vào marker
            // tham số là marker đang click và số thứ tự của message
            // như vậy nó sử dụng closure để thiết lập message cho  từng marker
            function attachSecretMessage(marker, message) 
            {
              var icon2 = 'http://google-maps-icons.googlecode.com/files/volleyball.png';
                // Danh sách message
//                var message = ['Welcome', 'To', 'M', 'Website', 'Freetuts.net'];
                 
                // Khởi tạo của sổ message
                var infowindow = new google.maps.InfoWindow({
                    content: message
                });
 
                // Gắn của sổ vào sự kiện clic vào marker
                google.maps.event.addListener(marker, 'mouseover', function() {
                   
                    // Hàm open có hai tham số đó là map nó đang được gắn vào và marker đó 
                    infowindow.open(marker.get('map'), marker);
//                    marker.setIcon(icon2);
                });
                google.maps.event.addListener(marker, 'mouseout', function(){
                  infowindow.close();
               });
            }
 
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        

				
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
//get_footer(); ?>

<div id="map" style="height: 800px;"></div>