<?php include 'settings.php' ; ?>
<style>html, body, #map-canvas {
  height: 100%;
  margin: 0px;
  padding: 0px
} </style>
<div id='map-canvas'></div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API ; ?>"></script>
<script type="text/javascript">

  var doors = [
    // Name,                    Lat,      Log,          id
    ['VHS',                     49.269083,-123.1080287, 1],
    ['Dude chilling park',      49.263791,-123.0956369, 2],
  ];

  function initialize() {
    var mapCenter = new google.maps.LatLng(49.2638164,-123.0911522);
    var mapOptions = {
      center: mapCenter,
      zoom: 15
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    setMarkers(map, doors);


  };

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

      var content     = '<strong>' + door[0] + "</strong><hr/><a href='door.php?act=view&id=" + String( door[3] ) + "'>More info</a>" ;
      var infowindow  = new google.maps.InfoWindow() ;

      google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
        return function() {
            infowindow.setContent(content);
            infowindow.open(map,marker);
        };
      })(marker,content,infowindow));
    }
  }



  google.maps.event.addDomListener(window, 'load', initialize);
</script>
