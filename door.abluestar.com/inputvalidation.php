<?php

/**
 * This function checks string to see if it contains any bad words.
 * returns true if a bad word is detected.
 *
 * This function is extreamly slow as it does file access.
 * List of bad words is from
 * https://github.com/shutterstock/List-of-Dirty-Naughty-Obscene-and-Otherwise-Bad-Words
 */
require_once( 'CensorWords.php' );
function isThereBadWords( $str ) {
  $c = new CensorWords() ;
  $result = $c->censorString( $str ) ;
  // print_r( $result );
  return ( sizeof( $result['matched'] ) > 0 ) ;
}

function isLonLat( $str ) {
  return preg_match('/^[+-]?(\d*\.\d+([eE]?[+-]?\d+)?|\d+[eE][+-]?\d+)$/', $str);
}

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
?>
