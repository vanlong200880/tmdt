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
	
	$args['posts_per_page'] = 4;
	$args['paged'] = $paged;
	
	
	$my_the_query = new WP_Query( $args );
  if($my_the_query->have_posts()): ?>
		<div class="col-md-8 show-search">
      <ul class="row" id="list-map">
		<?php 
    
    $jsonData = array();
    while ($my_the_query->have_posts()){
			$my_the_query->the_post(); 
      $attachment_id = get_post_thumbnail_id(get_the_ID());
      if (!empty($attachment_id)) { 
        $img = get_the_post_thumbnail(get_the_ID(),array(178,118));
      }else{
      $img = '<img src="'.get_stylesheet_directory_uri().'/images/default.jpg" alt="'.get_the_title().'" title="'.get_the_title().'">';
      }
      // create json map
      $address = get_field('address');
      $dataLatLng = geocode($address);
      $jsonData[] = array(
        'title' => get_the_title(),
        'lng' => $dataLatLng[0],
        'lat' => $dataLatLng[1],
        'address' => '<p class="address">'.get_field('address').'</p>',
        'vote' => '<p><span>Bình chọn:</span>'.do_shortcode('[ratings id="'.  get_the_ID().'" results="true"]').'</p>',
        'comment' => '<p class="review">Bình luận: <span>23.000</span></p>',
        'img' => $img,
        'baseurl' => get_the_permalink()
        
      );
      ?>
        
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
        <div id="map" style="width: 100%; height: 380px"></div>
        <style>
          .show-map{
            position: absolute;
            width: 350px;
            height: 200px;
            border: 1px solid #000;
            background: #FFF;
            color: #000;
            display: none;
            z-index: 1054;
          }
          .show-map:hover{
            display: block !important;
          }
        </style>
        <div class="show-map"></div>
				<table border="1"> 
          <tr> 
            <td> 
               
            </td> 
            <td valign="top" style="width:150px; text-decoration: underline; color: #4444ff;"> 
               <div id="side_bar"></div> 
            </td> 
          </tr> 
        </table>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDig37w0D8HPxteA9wKJCRtjMI2DuZNCWQ&language=vi"></script>
				<script>
          //<![CDATA[
          var side_bar_html = "";
          var gmarkers = []; 
          var gicons = [];
          var map = null;
          gicons["red"] = new google.maps.MarkerImage("<?php echo get_stylesheet_directory_uri(); ?>/images/marker_red.png",
          new google.maps.Size(20, 34),
          // The origin for this image is 0,0.
          new google.maps.Point(0,0),
          // The anchor for this image is at 9,34.
          new google.maps.Point(9, 34));
          var iconImage = new google.maps.MarkerImage('<?php echo get_stylesheet_directory_uri(); ?>/images/marker_red.png',
          // This marker is 20 pixels wide by 34 pixels tall.
          new google.maps.Size(20, 34),
          // The origin for this image is 0,0.
          new google.maps.Point(0,0),
          // The anchor for this image is at 9,34.
          new google.maps.Point(9, 34));
          var iconShadow = new google.maps.MarkerImage('http://www.google.com/mapfiles/shadow50.png',
          new google.maps.Size(37, 34),
          new google.maps.Point(0,0),
          new google.maps.Point(9, 34));
          var iconShape = {
              coord: [9,0,6,1,4,2,2,4,0,8,0,12,1,14,2,16,5,19,7,23,8,26,9,30,9,34,11,34,11,30,12,26,13,24,14,21,16,18,18,16,20,12,20,8,18,4,16,2,15,1,13,0],
              type: 'poly'
          };
          
          function getMarkerImage(iconColor) {
            if ((typeof(iconColor)=="undefined") || (iconColor==null)) { 
               iconColor = "red"; 
            }
            if (!gicons[iconColor]) {
               gicons[iconColor] = new google.maps.MarkerImage("<?php echo get_stylesheet_directory_uri(); ?>/images/marker_"+ iconColor +".png",
               // This marker is 20 pixels wide by 34 pixels tall.
               new google.maps.Size(20, 34),
               // The origin for this image is 0,0.
               new google.maps.Point(0,0),
               // The anchor for this image is at 6,20.
               new google.maps.Point(9, 34));
            } 
            return gicons[iconColor];

         }
         
        gicons["blue"] = getMarkerImage("blue");
        gicons["green"] = getMarkerImage("green");
        gicons["yelow"] = getMarkerImage("yellow");
        
        // A function to create the marker and set up the event window function 
        function createMarker(latlng,name,html,color, address, vote, comment, baseurl, img) {
            var contentString = html;
            var marker = new google.maps.Marker({
                position: latlng,
                icon: gicons[color],
                shadow: iconShadow,
                map: map,
                title: name,
                zIndex: Math.round(latlng.lat()*-100000)<<5
                });
            var overlay = new google.maps.OverlayView();
            overlay.draw = function() {};
            overlay.setMap(map);
            google.maps.event.addListener(marker, 'mouseover', function() {
//                infowindow.setContent(contentString); 
//                infowindow.open(map,marker);
                  var projection = overlay.getProjection(); 
                  var pixel = projection.fromLatLngToContainerPixel(marker.getPosition());
                  $(".show-map").css({top: pixel.y, left: pixel.x - 330, 'display': 'block'});
                  $(".show-map").empty().append(contentString);
                });
                // Switch icon on marker mouseover and mouseout
                google.maps.event.addListener(marker, "mouseover", function() {
                  marker.setIcon(gicons["yellow"]);
                });
                google.maps.event.addListener(marker, "mouseout", function() {
                  marker.setIcon(gicons["blue"]);
                  $(".show-map").css('display', 'none');
                });
            gmarkers.push(marker);
            // add a line to the side_bar html
            var marker_num = gmarkers.length-1;
            side_bar_html += '<li class="col-md-6" onmouseover="gmarkers['+marker_num+'].setIcon(gicons.yellow)" onmouseout="gmarkers['+marker_num+'].setIcon(gicons.blue)">';
              side_bar_html += '<div class="show-article-details">';
                side_bar_html += '<figure>';
                  side_bar_html += '<a href="'+baseurl+'" title="'+name+'">';
                    side_bar_html += img;
                    side_bar_html += '<div class="blur"></div>';
                  side_bar_html += '</a>';
                  side_bar_html += '<figcaption>';
                    side_bar_html += '<p><a href="'+baseurl+'" title="'+name+'">';
                        side_bar_html += name;
                      side_bar_html += '</a>';
                    side_bar_html += '</p>';
                    side_bar_html += address;
                    side_bar_html += vote;
                    side_bar_html += comment; 
                  side_bar_html +='</figcaption>';
                side_bar_html +='</figure>';
              side_bar_html +='</div>';
            side_bar_html +='</li>';
        }
        
        function myclick(i) {
          google.maps.event.trigger(gmarkers[i], "click");
        }

        function initialize() {
          // create the map
          var myOptions = {
            zoom: 12,
            center: new google.maps.LatLng(10.7596132, 106.6644058),
            mapTypeControl: false,
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
            navigationControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          map = new google.maps.Map(document.getElementById("map"),
                                        myOptions);

          google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
                });
                var beaches = <?php echo json_encode($jsonData) ?>;
                for (var i = 0; i < beaches.length; i++) {
                  var beach = beaches[i];
                  // obtain the attribues of each marker
                  var lat = beach.lng;
                  var lng = beach.lat;
                  var point = new google.maps.LatLng(lat,lng);
                  var html = '<div class="row">';
                  html += '<div class="col-md-8">';
                  html += '<p class="name"><a href="'+beach.baseurl+'">'+beach.title+'</a></p>';
                  html += beach.vote;
                  html += beach.comment;
                  html += '<p class="address">'+beach.address+'</p>';
                  html += '</div>';
                  html += '<div class="col-md-4">';
                  html += '<a href="'+beach.baseurl+'">'+beach.img+'</a>';
                  html += '</div>';
                  html += '</div>';
                  var label = beach.title;
                  var address = beach.address;
                  var vote = beach.vote;
                  var comment = beach.comment;
                  var baseurl = beach.baseurl;
                  var img = beach.img;
                  // create the marker
                  var marker = createMarker(point,label,html,"blue", address, vote, comment, baseurl, img);
                }
                // put the assembled side_bar_html contents into the side_bar div
                document.getElementById("list-map").innerHTML = side_bar_html;
            }

        var infowindow = new google.maps.InfoWindow(
          { 
            size: new google.maps.Size(150,50)
          });

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
get_footer(); ?>