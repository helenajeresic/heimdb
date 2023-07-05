<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/movies.class.php';
require_once __SITE_PATH .  '/model/rates.class.php';


class RatesService
{

    function getRatesByUserId( $id )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM rates WHERE id_user = :id ORDER BY date DESC');
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Rate ( $row['id_movie'], $row['id_user'], $row['rate'], $row['date']);
		}

		return $arr;
    }

    function rateMovie( $id_movie, $id_user, $rate)
    {
        $today_date = date_create()->format('Y-m-d');
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO rates (id_movie, id_user, rate, date)
                                VALUES (:id_movie, :id_user, :rate, :date);');
			$st->execute( array('id_movie' => $id_movie, 'id_user' => $id_user,
                                'rate' => $rate, 'date' => $today_date ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function getAverageRating($id_movie)
	{
    	try {
        	$db = DB::getConnection();
        	$st = $db->prepare('SELECT AVG(rate) AS average_rating
                            	FROM rates
                            	WHERE id_movie = :id_movie;');
        	$st->execute(array('id_movie' => $id_movie));
    	} catch (PDOException $e) {
        	exit('PDO error ' . $e->getMessage());
    	}
		$result = $st->fetch(); 
        $average_rating = $result['average_rating'];
        return round($average_rating,1);
	}


    function updateRating( $id_movie, $id_user, $rate)
    {
        $today_date = date_create()->format('Y-m-d');
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE rates
                                SET rate = :new_rate, date = :new_date
                                WHERE id_movie = :id_movie AND id_user = :id_user;');
			$st->execute( array('id_movie' => $id_movie, 'id_user' => $id_user,
                                'rate' => $rate, 'new_date' => $today_date ));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
}

?>
