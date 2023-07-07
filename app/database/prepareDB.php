<?php

require_once 'db.class.php';

$db = DB::getConnection();

$has_tables = false;

try
{
	$st = $db->prepare(
		'SHOW TABLES LIKE :tblname'
	);

	$st->execute( array( 'tblname' => 'users' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'movies' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;
    
    $st->execute( array( 'tblname' => 'persons' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;

	$st->execute( array( 'tblname' => 'directed_in' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

    $st->execute( array( 'tblname' => 'acted_in' ) );
    if( $st->rowCount() > 0 )
    	$has_tables = true;
    
    $st->execute( array( 'tblname' => 'rates' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;

    $st->execute( array( 'tblname' => 'watchlist' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;
    
    $st->execute( array( 'tblname' => 'comments' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;

}
catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }


if( $has_tables )
{
	exit( 'Tablice users / movies / persons / directed_in / acted_in / rates / watchlist / comments već postoje. ' .
            'Obrišite ih pa probajte ponovno.' );
}


try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS users (' .
		'id_user int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'username varchar(50) UNIQUE NOT NULL,' .
        'password_hash varchar(255) NOT NULL,' .
        'email varchar(255) NOT NULL,'. 
        'registration_sequence varchar(50) NOT NULL,' . 
        'has_registered int NOT NULL,' . 
        'is_admin int NOT NULL,' .
		'name varchar(50) NOT NULL,' .
		'surname varchar(50) NOT NULL,' .
		'date_of_birth date NOT NULL,' . 
        'penalty int NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu users.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS movies (' .
		'id_movie int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'title varchar(100) NOT NULL,' .
        'year int NOT NULL,' .
        'genre varchar(500) NOT NULL,' .
        'description varchar(500) NOT NULL,' .
        'image varchar(255) NOT NULL, ' .
		'duration int NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu movies.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS persons (' .
		'id_person int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'name varchar(50) NOT NULL,' .
		'surname varchar(50) NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu persons.<br />";

try
{
	$st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS directed_in (' .
        'id_person int NOT NULL,' .
        'id_movie int NOT NULL,' .
        'PRIMARY KEY (id_person, id_movie) )'
    );
    

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu directed_in.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS acted_in (' .
		'id_person int NOT NULL,' .
		'id_movie int NOT NULL,' .
        'PRIMARY KEY (id_person, id_movie) )' 
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu acted_in.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS rates (' .
		'id_movie int NOT NULL,' .
		'id_user int NOT NULL, ' . 
        'rate int NOT NULL, ' . 
        'date date NOT NULL, ' . 
        'PRIMARY KEY (id_movie, id_user) )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu rates.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS watchlist (' .
		'id_user int NOT NULL, ' .
		'id_movie int NOT NULL, ' . 
        'status int NOT NULL, ' . 
        'PRIMARY KEY (id_user, id_movie) )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu watchlist.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS comments (' .
		'id_comment int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_user int NOT NULL, ' . 
        'id_movie int NOT NULL, ' .
        'content varchar(20000) NOT NULL, ' . 
        'date date NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create person]: " . $e->getMessage() ); }

echo "Napravio tablicu comments.<br />";

?>