<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/movies.class.php';
require_once __SITE_PATH .  '/model/comments.class.php';

class MovieService
{

    function getAllMovies()
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM movies ORDER BY title');
			$st->execute();
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

    function getMovieById( $id_movie )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM movies WHERE id_movie = :id_movie');
			$st->execute( array( 'id_movie' => $id_movie ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		$param = new Movie ($row['id_movie'], $row['title'],$row['year'],  $row['genre'],
                            $row['description'],  $row['image'],  $row['duration'] );

		if( $row === false )
			return null;
		else
			return $param;
	}

    function searchMovieByTitle( $title )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM movies WHERE title LIKE :title');
			$st->execute( array( 'title' => '%' . $title . '%' ) );
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

    function searchMovieByGenre( $genre )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM movies WHERE genre LIKE :genre');
			$st->execute( array( 'genre' => '%' . $genre . '%' ) );
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

    function searchMovieByYear( $year )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM movies WHERE year = :year');
			$st->execute( array( 'year' =>  $year ) );
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

	function addMovie( $id_movie, $title, $year, $genre, $description, $image, $duration )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO movies (id_movie, title, year, genre, description, image, duration)
								VALUES(:id_movie, :title, :year, :genre, :description, :image, :duration)');
			$st->execute( array( 'year' =>  $year ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}

	function getTopRated()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.*
								FROM movies m
								INNER JOIN (
									SELECT id_movie, AVG(rate) AS average_rating
									FROM rates
									GROUP BY id_movie
									ORDER BY average_rating DESC
									LIMIT 10
								) AS top_movies ON m.id_movie = top_movies.id_movie;');
			$st->execute();
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

	function getMostWatched()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.*, COUNT(w.id_movie) AS views_count
								FROM movies m
								INNER JOIN watchlist w ON m.id_movie = w.id_movie
								WHERE w.status = 1
								GROUP BY m.id_movie, m.title
								ORDER BY views_count DESC
								LIMIT 10;');
			$st->execute();
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

	function getMostPopular()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT m.*, COUNT(w.id_movie) AS appearance_count
								FROM movies m
								INNER JOIN watchlist w ON m.id_movie = w.id_movie
								GROUP BY m.id_movie, m.title
								ORDER BY appearance_count DESC
								LIMIT 10');
			$st->execute();
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

	

	function getMovieRecommendations()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM movies
								ORDER BY RAND()
								LIMIT 5');
			$st->execute();
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
}

?>
