<?php require_once('settings.php') ; ?>
<div class='page container'>
  <h1><?php echo $page['data']['name'] ; ?></h1>
  <p><?php echo $page['data']['body'] ; ?></p>

  <hr>
</div>
<div class="container">
  <div class="row">
    <div class='col-md-8'>
      <h3>Comments</h3>
      <p><em>Please consider taking a picture of the magic door to add to your comments.</em></p>
      <!-- disqus thread.-->
      <div id="disqus_thread"></div>
    </div>
    <div class='col-md-4'>
      <h3>Location of the door</h3>
      <div id='map-canvas'></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  /* * * CONFIGURATION VARIABLES * * */
  var disqus_shortname  = '<?php echo DISQUS_SHORTNAME ; ?>';
  var disqus_identifier = '<?php echo $page['data']['slug'] ; ?>';

  /*** DON'T EDIT BELOW THIS LINE ***/
  (function() {
      var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
      dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  }());
</script>







<style>
#map-canvas {
  height: 400px;
  width: 100%;
} </style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API ; ?>"></script>
<script type="text/javascript">
  function initialize() {
    var mapOptions = {
      zoom: 15
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var marker ;
    placeMarker( new google.maps.LatLng( <?php echo $page['data']['lon'] ; ?>, <?php echo $page['data']['lng'] ; ?>) );


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
    }
  };
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
