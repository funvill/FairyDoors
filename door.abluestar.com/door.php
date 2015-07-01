<?php
// Connect to the MyThings database.
require_once('class.MyDoors.php');
$db = new MyDoors();



// SEt default for act
$page['act'] = 'about' ;

// Check to see if there was a act set.
if( isset($_REQUEST['act'] ) ) {
	// Check to make sure that its a valid act, else use default
	if( in_array( $_REQUEST['act'], array('about', 'map', 'view', 'add', 'debug') ) ) {
		$page['act'] = $_REQUEST['act'] ;
		$page['title'] = ucfirst( $page['act'] ) ; // First letter should be uppercase 
	}
}

if( $page['act'] == 'add' &&
    isset( $_REQUEST['name'] ) && isset( $_REQUEST['description'] ) &&
    isset( $_REQUEST['longitude'] ) && isset( $_REQUEST['latitude'] ) )
{
    // Generate a slug
    // From http://cubiq.org/the-perfect-php-clean-url-generator
    setlocale(LC_ALL, 'en_US.UTF8');
    function toAscii($str, $replace=array(), $delimiter='-') {
    	if( !empty($replace) ) {
    		$str = str_replace((array)$replace, ' ', $str);
    	}
    	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    	$clean = strtolower(trim($clean, '-'));
    	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
      $clean = strtolower(trim($clean, '-'));
    	return $clean;
    }
		$slug = toAscii( $_REQUEST['name'] ) ;

		// Remove any scripting from the description or name.
		$name = strip_tags( $_REQUEST['name'] ) ;
		$description = strip_tags( $_REQUEST['description'] ) ;
		$latitude = strip_tags( $_REQUEST['latitude'] ) ;
		$longitude = strip_tags( $_REQUEST['longitude'] ) ;

    // Add this door.
    $db->Update( $slug, $name, $description, $latitude , $longitude ) ;

		// ToDo: redirect to the door page.
    echo '<div class="page container"><p class="bg-success">Magic door added</p></div>';
		echo '<a href="?act=view&slug='. $slug .'">'. $name .'</a>' ;
		exit();
}


if( $page['act'] == 'view' ) {
	$page['data']['slug'] = "error";
	if( isset( $_REQUEST['slug'] ) ) {
		$page['data']['slug'] =  $_REQUEST['slug'] ;
		$page['data'] = $db->GetBySlug( $page['data']['slug'] ) ;
		if( $page['data'] === false ) {
			// We could not find this door.
			$page['act'] = '404' ;
		} else {
			// Title
			$page['title'] = $page['data']['name'] ;
		}
	} else {
		// We could not find this door.
		$page['act'] = '404' ;
	}
}

// Generate template name
// This is guaranteed to be an expected value. Checked in header of file.
$page['template'] = 'tp_' . $page['act'] . '.php' ;
if( ! file_exists($page['template'] ) || $page['act'] == '404' ) {
	// The file can not be found.
	$page['act'] = '404' ;
	$page['title'] = $page['act'] ;
	$page['template'] = 'tp_' . $page['act'] . '.php' ;
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if( isset( $page['title'] ) ) { echo $page['title'] . ' -' ; } ?> Magic Door</title>
    <meta name="description" content="A map of magic doors around the world.">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
  </head>
	<body>
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Top nav -->
		<?php include 'tp_nav.php' ; ?>

		<!-- content -->
		<?php include $page['template'] ; ?>

    <!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- Google Analytics -->
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-301766-41','auto');ga('send','pageview');
		</script>
	</body>
</html>
