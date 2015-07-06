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
        <li <?php if( $page['act'] == 'add'     ) { echo 'class="active"' ; } ?> ><a href="?act=add">Add</a></li>
      </ul>

      <!-- search bar -->
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>



    </div><!--/.nav-collapse -->
  </div>
</nav>
