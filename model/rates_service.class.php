<?php

require_once __SITE_PATH .  '/model/movies.class.php';


class RatesService
{
    function rateMovie( $id_movie, $id_user, $rate, $date)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO rates (id_movie, id_user, rate, date)
                                VALUES (:id_movie, :id_user, :rate, :date);');
			$st->execute( array('id_movie' => $id_movie, 'id_user' => $id_user, 
                                'rate' => $rate, 'date' => $date ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function getAverageRating( $id_movie )
    {   
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT AVG(rate) AS average_rating
                                FROM rates
                                WHERE id_movie = :movie_id;');
			$st->execute( array( 'id_movie' => $id_movie ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
     
    function updateRating( $id_movie, $id_user, $rate, $date)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE rates
                                SET rate = :new_rate, date = :new_date
                                WHERE id_movie = :id_movie AND id_user = :id_user;');
			$st->execute( array('id_movie' => $id_movie, 'id_user' => $id_user, 
                                'rate' => $rate, 'date' => $date ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
}

?>