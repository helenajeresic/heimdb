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

	function addMovie($title, $year, $genres, $description, $imageName, $imagePath, $duration, $directorNames, $directorSurnames, $actorNames, $actorSurnames)
	{	
		$this->processImageUpload($imageName, $imagePath);
		try 
		{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO movies (title, year, genre, description, image, duration)
								VALUES (:title, :year, :genre, :description, :image, :duration)');
			$st->execute(array(
				'title' => $title,
				'year' => $year,
				'genre' => $genres,
				'description' => $description,
				'image' => $imageName,
				'duration' => $duration
			));

			$movieId = $db->lastInsertId();

			for ($i = 0; $i < count($directorNames); $i++) 
			{
				$directorName = $directorNames[$i];
				$directorSurname = $directorSurnames[$i];

				$directorId = $this->findOrCreatePerson($db, $directorName, $directorSurname);

				$stCheckDirectedIn = $db->prepare('SELECT * FROM directed_in WHERE id_person = :id_person AND id_movie = :id_movie');
				$stCheckDirectedIn->execute(array(
					'id_person' => $directorId,
					'id_movie' => $movieId
				));
			
				if ($stCheckDirectedIn->rowCount() === 0) {
					$stDirectedIn = $db->prepare('INSERT INTO directed_in (id_person, id_movie) VALUES (:id_person, :id_movie)');
					$stDirectedIn->execute(array(
						'id_person' => $directorId,
						'id_movie' => $movieId
					));
				}
			}

			for ($i = 0; $i < count($actorNames); $i++) 
			{
				$actorName = $actorNames[$i];
				$actorSurname = $actorSurnames[$i];

				$actorId = $this->findOrCreatePerson($db, $actorName, $actorSurname);

				$stCheckActedIn = $db->prepare('SELECT * FROM acted_in WHERE id_person = :id_person AND id_movie = :id_movie');
				$stCheckActedIn->execute(array(
					'id_person' => $actorId,
					'id_movie' => $movieId
				));

				if ($stCheckActedIn->rowCount() === 0) {
					$stActedIn = $db->prepare('INSERT INTO acted_in (id_person, id_movie) VALUES (:id_person, :id_movie)');
					$stActedIn->execute(array(
						'id_person' => $actorId,
						'id_movie' => $movieId
					));
				}
			}
		} catch (PDOException $e) {
			exit('PDO error ' . $e->getMessage());
		}
	}

	function findOrCreatePerson($db, $name, $surname)
	{
		$stPerson = $db->prepare('SELECT id_person FROM persons WHERE name = :name AND surname = :surname');
		$stPerson->execute(array(
			'name' => $name,
			'surname' => $surname
		));

		if ($stPerson->rowCount() > 0) 
		{
			$row = $stPerson->fetch();
			return $row['id_person'];
		} 
		else 
		{
			$stInsertPerson = $db->prepare('INSERT INTO persons (name, surname) VALUES (:name, :surname)');
			$stInsertPerson->execute(array(
				'name' => $name,
				'surname' => $surname
			));
			return $db->lastInsertId();
		}
	}

	
	function processImageUpload($name, $tmp_name) 
	{
        require_once __SITE_PATH . '/app/start.php';
        
		$extension = explode('.',$name);
        $extension = strtolower(end($extension));
        $key = md5((uniqid()));
        $tmp_file_name = "{$key}.{$extension}";
        $tmp_file_path = __SITE_PATH . "/tmp_files/{$tmp_file_name}";
        move_uploaded_file($tmp_name, $tmp_file_path);
        try {
            $s3->putObject([
                'Bucket' => $config['s3']['bucket'],
                'Key' => "{$name}",
                'Body' => fopen($tmp_file_path, 'rb')
            ]);
            unlink($tmp_file_path);
        } catch(exception $e) {
            die("There was an exception" . $e);
        }
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
