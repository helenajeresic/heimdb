<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/persons.class.php';

class PersonService
{
    function getPersonById( $id ){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM persons WHERE id_person = :id');
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();
        if( $row === false ){

            return null;
        }
        else {
            return new Person ( $row['id_person'], $row['name'], $row['surname'] );
        }
    }

    function getPersonByName( $name ){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM persons WHERE name = :name');
			$st->execute( array( 'name' => $name ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();
        if( $row === false ){

            return null;
        }
        else {
            return new Person ( $row['id_person'], $row['name'], $row['surname'] );
        }
    }

    function getPersonBySurname( $surname ){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM persons WHERE surname = :surname');
			$st->execute( array( 'surname' => $surname ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();
        if( $row === false ){

            return null;
        }
        else {
            return new Person ( $row['id_person'], $row['name'], $row['surname'] );
        }
    }

    function getDirectorsForMovie( $id_movie ){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM directed_in WHERE id_movie = :id_movie ');
			$st->execute( array( 'id_movie' => $id_movie ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = $row['id_person'];
		}

		return $arr;
    }

    function getActorsForMovie( $id_movie ){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM acted_in WHERE id_movie = :id_movie ');
			$st->execute( array( 'id_movie' => $id_movie ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = $row['id_person'];
		}

		return $arr;
    }
}

 ?>
