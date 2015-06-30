<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?act=about">Magic Doors</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php if( $page['act'] == 'about'   ) { echo 'class="active"' ; } ?> ><a href="?act=about">About</a></li>
        <li <?php if( $page['act'] == 'map'     ) { echo 'class="active"' ; } ?> ><a href="?act=map">Map</a></li>
        <li <?php if( $page['act'] == 'contact' ) { echo 'class="active"' ; } ?> ><a href="?act=contact">Contact</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
