<?php include 'settings.php' ; ?>
<div class='page container'>
  <div class="row">
    <div class='col-md-6'>
      <h3>Add a new Magic door</h3>
      <p>You can add a new door here. blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab blab </p>

      <form action="?act=add" method="post" >

        <div class="form-group">
          <label for="name">Name of the door</label>
          <input type='text' class="form-control" name='name' data-minlength="6" required />
        </div>

        <div class="form-group">
          <label for="description">Description of the door</label><br />
          <p class="help-block"><em>A short description of the door, or a story of the creature that lives behind it.</em></p>
          <textarea name='description' style="width: 100%; height: 100px;"></textarea>
        </div>

        <div class="form-group">
          <div class="row">
            <div class='col-sm-6'>
              <label for="longitude">Longitude</label><br /><input id='longitude' name='longitude' type='text' class="form-control" required />
            </div>
            <div class='col-sm-6'>
              <label for="latitude">Latitude</label><br /><input id='latitude' name='latitude' type='text' class="form-control" required />
            </div>
          </div>
          <p class="help-block"><em>Click the map to change the Longitude/Latitude</em></p>
        </div>


        <button type="submit" class="btn btn-default">Submit</button>
      </form>

    </div>

    <div class='col-md-6'>
      <h3>Door location</h3>
      <p>Click the map to add a marker for the doors location. Click the map again to move the maker</p>
      <div id='map-canvas'></div>
    </div>
  </div>
</div>


<style>
#map-canvas {
  height: 400px;
  width: 100%;
} </style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API ; ?>"></script>
<script type="text/javascript">
  function initialize() {
    var mapOptions = {
      zoom: 14
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    // Try HTML5 geolocation
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        map.setCenter(pos);
      }, function() {
        map.setCenter( new google.maps.LatLng(<?php echo GOOGLE_MAP_DEFAULT_LOCATION_LATITUDE ;?> ,<?php echo GOOGLE_MAP_DEFAULT_LOCATION_LONGITUDE ; ?>) );
      });
    } else {
      // Browser doesn't support Geolocation
      map.setCenter( new google.maps.LatLng(<?php echo GOOGLE_MAP_DEFAULT_LOCATION_LATITUDE ; ?>, <?php echo GOOGLE_MAP_DEFAULT_LOCATION_LONGITUDE ; ?>) );
    }


    var marker ;
    google.maps.event.addListener(map, 'click', function(event) {
       placeMarker(event.latLng);
    });

    function placeMarker(location) {
      if (marker == undefined){
          marker = new google.maps.Marker({
              position: location,
              map: map,
              animation: google.maps.Animation.DROP
          });
      } else {
          marker.setPosition(location);
      }
      map.setCenter(location);

      // Update the forum
      document.getElementById("longitude").value = location.lng();
      document.getElementById("latitude").value = location.lat() ;

    }

  };


  google.maps.event.addDomListener(window, 'load', initialize);
</script>