<?php

require_once 'comments.class.php'

class CommentService
{
    function getCommentsById( $id ){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM comments WHERE id_comment = :id');
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();
        if( $row === false ){

            return null;
        }
        else {
            return new Comment ( $row['id_comment'], $row['id_user'], $row['id_movie'], $row['content'], $row['date']);
        }
    }

    function getCommentsByUserId( $id )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM comments WHERE id_user = :id ORDER BY date DESC');
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Comment ( $row['id_comment'], $row['id_user'], $row['id_movie'], $row['content'], $row['date']);
		}

		return $arr;
    }

    function getCommentsByMovieId( $id )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM comments WHERE id_movie = :id ORDER BY date DESC');
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Comment ( $row['id_comment'], $row['id_user'], $row['id_movie'], $row['content'], $row['date']);
		}

		return $arr;
    }

    function addComment ( $id_user, $id_movie, $content )
    {
        $today_date = date_create()->format('Y-m-d');
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT INTO comments (id_user, id_movie, content, date) VALUES (:id_user, :id_movie, :content, :date)' );
			$st->execute( array('id_user' => $id_user, 'id_movie' => $id_movie, 'content' => $content, 'date' => $today_date) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    }

    function removeComment ( $id_comment )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'DELETE FROM comments WHERE id_comment = :id_comment' );
			$st->execute( array('id_comment' => $id_comment) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    }
}

 ?>
