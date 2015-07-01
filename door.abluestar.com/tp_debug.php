<?php
// Connect to the MyThings database.
require_once('class.MyDoors.php');
$db = new MyDoors();

$db->Update( 'vhs',  'Vancouver Hackspace door', 'This is the Vancouver hackspace door', '49.269083','-123.1080287' ) ;
$db->Update( 'dude', 'Dude chilling park door',  'This is the Dude chilling park door',  '49.263791','-123.0956369' ) ;

$page['data'] = $db->GetAll( ) ;

echo '<div class="page container">';
echo '<ul>';
foreach( $page['data'] as $thing ) {
	print_r( $thing );
}
echo '</ul>';
echo '</div>';
?>
