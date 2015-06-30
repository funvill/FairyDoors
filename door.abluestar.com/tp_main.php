<div class="jumbotron">
  <h1>Magic doors</h1>
  <p>As we all know, little doors are portals to magical places. They can lean one to gnomes, fairies, and many other types of magical creatures!</p>
</div>




<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZki_diA0TUgFKWcxcrPijDOYTg0k27Ak"></script>
<script type="text/javascript">
  function initialize() {
    var mapCenter = new google.maps.LatLng(49.2638164,-123.0911522);
    var mapOptions = {
      center: mapCenter,
      zoom: 15
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    setMarkers(map, doors);
  };

  var doors = [
    ['VHS', 49.269083,-123.1080287],
    ['Dude chilling park', 49.2637911,-123.0956369],
  ];

  function setMarkers(map, locations) {
    // Add markers to the map
    for (var i = 0; i < locations.length; i++) {
      var door = locations[i];
      var doorLatLng = new google.maps.LatLng(door[1], door[2]);
      var marker = new google.maps.Marker({
          position: doorLatLng,
          map: map,
          title: door[0]
      });
    }
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div class='map-canvas'></div>
