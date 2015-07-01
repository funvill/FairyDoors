<?php require_once('settings.php') ; ?>
<style>html, body, .page, #map-canvas {
  height: 100%;
} </style>

<div class='page'>
  <div id='map-canvas'></div>
</div>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API ; ?>"></script>
<script type="text/javascript">

  var doors = [
    //   Name,                     Lat,      Log,          slug
    // ['VHS',                     49.269083,-123.1080287, vhs],
    <?
    $page['data'] = $db->GetAll( ) ;
    foreach( $page['data'] as $door ) {
    	echo '["'.$door['name'].'", '. $door['lon'] .','. $door['lng'] .',"'. $door['slug'] ."\"],\n";
    }
    ?>
  ];

  function initialize() {
    var mapCenter = new google.maps.LatLng(<?php echo GOOGLE_MAP_DEFAULT_LOCATION_LATITUDE ;?> ,<?php echo GOOGLE_MAP_DEFAULT_LOCATION_LONGITUDE ; ?>);
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

      var content     = "<a href='door.php?act=view&slug=" + door[3] + "'><strong>" + door[0] + "</strong></a>" ;
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
