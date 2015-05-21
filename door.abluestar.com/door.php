<?php 

require_once( 'class.MyThing.php');


// Display logic 
// --------------------------------
// Default, List all pages 
$page['act']  	= ''; 
$page['title']  = ''; 
$page['slug']	= '';

// Check to see if ACT is set
if( isset($_REQUEST['act'] ) ) {
	// Check to make sure that its a valid act 
	if( in_array( $_REQUEST['act'], array('edit', 'view', 'list', 'update') ) ) {
		$page['act'] = $_REQUEST['act'] ; 
	} else {
		echo 'Error (1): Unknow act=['. $_REQUEST['act'] .']';
	}
} else {
	$page['act']  	= 'list'; // Default 

	if( strlen( DEFAULT_THING ) > 0 ) {
		$page['act']  = 'view' ;
		$page['slug'] = DEFAULT_THING ; 
	}
}

// Check to see if we have defined a slug. 
if( isset($_REQUEST['thing'] ) ) {
	$page['slug'] = $_REQUEST['thing'] ;
} 

// Connect to the MyThings database. 
$db = new MyThing();

// Get the data depending on the act. 
switch( $page['act'] ) {
	case 'view': {
		$page['data'] = $db->GetBySlug( $page['slug'] ) ;
		$page['title'] = $page['data']['name'] ; 
		break; 
	}
	case 'list': {
		$page['data'] = $db->GetAll( ) ;
		$page['title'] = 'List all' ; 
		break ; 
	}
	case 'edit':
	{
		if( ! isset( $page['slug']) ) {
			echo "Error: Missing required prameters, slug" ; 
			die();			
		}
		$page['data'] = $db->GetBySlug( $page['slug'] ) ;
		$page['title'] = 'Edit '. $page['slug'] ;
		break; 
	} 
	case 'update': 
	{
		if( ! isset($_REQUEST['name'] ) || ! isset($_REQUEST['body'] ) /* || ! isset($_REQUEST['address'] ) */ ) {
			echo "Error: Missing required prameters" ; 
			die(); 
		}

		// Update the database 
		$db->Update( $page['slug'], $_REQUEST['name'], $_REQUEST['body'], /*$_REQUEST['address']*/ "" ); 

		// Redirect to the view page. 
		header('Location: http://'. $_SERVER['HTTP_HOST'] .'/?thing='. $page['slug'] .'&act=view');
		exit;		
	}
}





// echo '<pre>'; var_dump( $page ) ; echo '</pre>'; 


// This should all be put in to a template file 
// But I wanted this to be as simple as possiable. 
?><!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $page['title'] ; ?> - <?php echo PROJECT_NAME ; ?></title>
    <meta name="description" content="A page where you can comment on things">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Top nav -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <h1><?php echo PROJECT_NAME ; ?></h1>
          <a href='?act=list'>List all </a>
        </div>
      </div>
    </nav>

    <!-- Main content -->
<?php 
// Only show the comment thread on the single page thread. 
if( $page['act'] == 'view' ) { ?>	

		<div class="container">
			<h2><?php echo $page['data']['name'] ; ?></h2>
			<p><?php echo $page['data']['body'] ; ?></p>

			<?php 
			/*
			// Display the map if needed. 
			if( strlen( $page['data']['address'] ) > 0 ) { ?>
			<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode( $page['data']['address'] ) ; ?>&key=<?php echo GOOGLE_MAP_API ;?>"></iframe>
			<?php } 
			*/ ?>

			<!-- disqus thread.-->
			<div id="disqus_thread"></div>
		</div>

<?php } else if ( $page['act'] == 'list' ) {

		echo '<div class="container">';
		echo '<ul>'; 
		foreach( $page['data'] as $thing ) {
			echo '<li><a href="/?thing='. $thing['slug'] .'&act=view">'. $thing['name'] .'</a></li>'; 
		}
		echo '</ul>'; 
		echo '</div>';

} else if ( $page['act'] == 'edit' ) { ?>

		<form action='/?act=update' method='POST'>
			<!-- <label for='slug'>Slug:</label><br />--><input id='slug' type='hidden' name='thing' value='<?php echo $page['slug'] ; ?>' readonly /> <!-- Read only<br /> -->
			<label for='name'>Name:</label><br /><input id='name' type='text' name='name' value='<?php echo $page['data']['name'] ; ?>' /><br />
			<!-- <label for='name'>Address:</label><br /><input id='name' type='text' name='address' value='<?php echo $page['data']['address'] ; ?>' /><br /> -->
			<label for='body'>Body:</label><br /><textarea id='body' name='body'><?php echo $page['data']['body'] ; ?></textarea><br />
			<input type='submit'>
		</form>

<?php } ?>

		<footer>
<?php if( $page['act'] == 'view' ) { ?>	

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
<?php } ?>

		</footer>	
</body>
</html>