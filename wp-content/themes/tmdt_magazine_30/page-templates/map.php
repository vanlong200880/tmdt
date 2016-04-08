<?php get_header() ?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div id="map" style="height: 600px; width: 100%;"></div>
		</div>
	</div>
</div>

    
    <script>

// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
// to the base of the flagpole.

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: {lat: 10.7596132, lng: 106.6644058}
  });

  setMarkers(map);
}

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
var beaches = [
  ['Bondi Beach', 10.7596132, 106.6644058, 4],
  ['Coogee Beach', 10.7569555, 106.6574975, 5],
  ['Cronulla Beach', 10.7824952, 106.6641063, 3],
  ['Manly Beach', 10.7953893, 106.6443262, 2],
  ['Maroubra Beach', 10.7869812, 106.6693443, 1]
];

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
  for (var i = 0; i < beaches.length; i++) {
    var beach = beaches[i];
    var marker = new google.maps.Marker({
      position: {lat: beach[1], lng: beach[2]},
      map: map,
//      icon: image,
      shape: shape,
      title: beach[0],
      zIndex: beach[3]
    });
  }
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDig37w0D8HPxteA9wKJCRtjMI2DuZNCWQ&signed_in=true&callback=initMap"></script>

<?php get_footer(); ?>