<?php 
/**
 * Forked from https://github.com/funvill/CommentOnThing
 * 
 * SINGLE FILE thing comment system.
 *
 * Tables:
 * -------------------------
 * Things
 *   slug - URI slug 
 *   name - Title of the thing
 *   body - Contents of the page 
 * 
 */ 
 
 
require_once( 'settings.php');


class MyThing extends SQLite3
{
    function __construct()
    {
        $this->open( SQLITE_DATABASE );
        
        // Ensure that the database has the correct table. 
    	$st=$this->prepare( 'CREATE TABLE IF NOT EXISTS things (slug STRING PRIMARY KEY, name STRING, body STRING, address STRING)' );	
    	$st->execute( );
    }

    function GetBySlug( $slug ) {

    	$st=$this->prepare('SELECT * FROM things WHERE slug=?');			
			$st->bindParam(1, $slug, SQLITE3_TEXT);
			$result = $st->execute( );
    	if( $result == false ) {
    		return false; 
    	}
			return $result->fetchArray( SQLITE3_ASSOC ) ;
    }

    function GetAll( ) {
    	$st=$this->prepare('SELECT * FROM things');	
    	$result = $st->execute( );

    	// Loop thought the results. 
			$results = array() ; 
			while( $row = $result->fetchArray( SQLITE3_ASSOC ) ) {
				$results[] = $row ; 
			}
			return $results; 
    }

    function Update( $slug, $name, $body, $address ) {
    	// http://stackoverflow.com/questions/15277373/sqlite-upsert-update-or-insert

    	// Do this in a safe way 
    	$st=$this->prepare('UPDATE things SET name=?, body=?, address=? WHERE slug=? ;');			
			$st->bindParam(1, $name, SQLITE3_TEXT);
			$st->bindParam(2, $body, SQLITE3_TEXT);
			$st->bindParam(3, $address, SQLITE3_TEXT);
			$st->bindParam(4, $slug, SQLITE3_TEXT);
			$st->execute(); 

    	$st=$this->prepare('INSERT OR IGNORE INTO things (slug, name, body, address) VALUES (?, ?, ?, ?); ');
			$st->bindParam(1, $slug, SQLITE3_TEXT);
			$st->bindParam(2, $name, SQLITE3_TEXT);
			$st->bindParam(3, $body, SQLITE3_TEXT);
			$st->bindParam(4, $address, SQLITE3_TEXT);
			$st->execute(); 
    }
}

?>