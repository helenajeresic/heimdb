<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/movies.class.php';


class WatchlistService
{
    function getUsersWatchlistById( $id )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.title, m.year, m.genre, m.description, m.image, m.duration
                                FROM movie m
                                JOIN watchlist w ON m.id_movie = w.id_movie
                                WHERE w.id_user = :id AND w.status = 0; ');
			$st->execute( array( 'id' => $id ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Movie ($row['id_movie'], $row['title'],$row['year'],  $row['genre'], 
                                $row['description'],  $row['image'],  $row['duration'] );
		}
		return $arr;
    }

    function getUsersWatchlistByName( $name )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.title, m.year, m.genre, m.description, m.image, m.duration
                                FROM movie m
                                JOIN watchlist w ON m.id_movie = w.id_movie
                                JOIN user u ON w.id_user = u.id_user
                                WHERE u.name = :name AND w.status = 0;');
			$st->execute( array( 'name' => $name ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Movie ($row['id_movie'], $row['title'],$row['year'],  $row['genre'], 
                                $row['description'],  $row['image'],  $row['duration'] );
		}
		return $arr;
    }

    function addMovieToWatchlist( $id_user, $id_movie)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO watchlist (id_user, id_movie, status)
								VALUES (:id_user, :id_movie, 0);');
			$st->execute( array( 'id_user' => $id_user, 'id_movie' => $id_movie));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function removeMovieFromWatchlist($id_user, $id_movie )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('DELETE FROM watchlist
								WHERE id_user = :id_user AND id_movie = :id_movie AND status = 0;');
			$st->execute( array( 'id_user' => $id_user, 'id_movie' => $id_movie));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function getWatchedMoviesById( $id )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.title, m.year, m.genre, m.description, m.image, m.duration
                                FROM movie m
                                JOIN watchlist w ON m.id_movie = w.id_movie
                                WHERE w.id_user = :id AND w.status = 1; ');
			$st->execute( array( 'id' => $id ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Movie ($row['id_movie'], $row['title'],$row['year'],  $row['genre'], 
                                $row['description'],  $row['image'],  $row['duration'] );
		}
		return $arr;
    }

	function getWatchedMoviesByName( $name )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.title, m.year, m.genre, m.description, m.image, m.duration
                                FROM movie m
                                JOIN watchlist w ON m.id_movie = w.id_movie
                                JOIN user u ON w.id_user = u.id_user
                                WHERE u.name = :name AND w.status = 1;');
			$st->execute( array( 'name' => $name ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Movie ($row['id_movie'], $row['title'],$row['year'],  $row['genre'], 
                                $row['description'],  $row['image'],  $row['duration'] );
		}
		return $arr;
    }

    function addWatchedMovie( $id_user, $id_movie )
    {
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE watchlist
								SET status = 1
								WHERE id_user = :id_user AND id_movie = :id_movie;');
			$st->execute( array( 'id_user' => $id_user, 'id_movie' => $id_movie));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function removeWatchedMovie( $id_user, $id_movie)
    {
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE watchlist
								SET status = 0
								WHERE id_user = :id_user AND id_movie = :id_movie;');
			$st->execute( array( 'id_user' => $id_user, 'id_movie' => $id_movie));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

}

?>