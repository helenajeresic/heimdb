<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/users.class.php';

class UserService {

    public function __construct() {}

    function getUserByUsername( $username )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM users WHERE username=:username' );
			$st->execute( array( 'username' => $username ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User( $row['id_user'],$row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'],
             $row['is_admin'], $row['name'], $row['surname'], $row['date_of_birth'], $row['penalty'] );
	}

    function updateName($username, $name)
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET name = :name WHERE username = :username');
            $st->execute( array( 'username' => $username , 'name' => $name ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function updateSurname($username, $surname)
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET surname = :surname WHERE username = :username');
            $st->execute( array( 'username' => $username , 'surname' => $surname ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function updateEmail($username, $email)
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET email = :email WHERE username = :username');
            $st->execute( array( 'username' => $username , 'email' => $email ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function updateDate($username, $date)
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET date_of_birth = :date WHERE username = :username');
            $st->execute( array( 'username' => $username , 'date' => $date ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }


	function makeNewUser( $username, $password, $email, $reg_seq, $name, $surname )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT INTO users(username, password_hash, email, registration_sequence, has_registered, is_admin, name, surname, date_of_birth, penalty) VALUES ' .
								'(:username, :password_hash, :email, :registrationSequence, 0, 0, :name, :surname, :date_of_birth , 0)' );

			$st->execute( array( 'username' => $username,
								'password_hash' => password_hash( $password, PASSWORD_DEFAULT ),
								'email' => $email,
								'registrationSequence'  => $reg_seq,
								'name' => $name,
								'surname' => $surname,
								'date_of_birth' => '1999-01-01') );
		}
		catch( PDOException $e ) { exit( 'Greška u bazi: ' . $e->getMessage() ); }
	}

    function getUserByRegSeq( $reg_seq )
    {
        $db = DB::getConnection();

        try
        {
            $st = $db->prepare( 'SELECT * FROM users WHERE registration_sequence=:reg_seq' );
            $st->execute( array( 'reg_seq' => $reg_seq ) );
        }
        catch( PDOException $e ) { exit( 'Greška u bazi: ' . $e->getMessage() ); }
        $row = $st->fetch();

        if( $st->rowCount() !== 1 )
            return false;
        else
        {
            try
            {
                $st = $db->prepare( 'UPDATE users SET has_registered=1 WHERE registration_sequence=:reg_seq' );
                $st->execute( array( 'reg_seq' => $reg_seq ) );
            }
            catch( PDOException $e ) { exit( 'Greška u bazi: ' . $e->getMessage() ); }

            return true;
        }
    }

	function getUserById( $id_user )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM users WHERE id_user=:id_user' );
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User( $row['id_user'],$row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'],
             $row['is_admin'], $row['name'], $row['surname'], $row['date_of_birth'], $row['penalty'] );
	}

	function deleteUsers($usersToDelete)
	{
		try
		{
			$db = DB::getConnection();
			$users = implode(',', array_fill(0, count($usersToDelete), '?'));

			$sql = "DELETE FROM users WHERE id_user IN ($users)";
			$st = $db->prepare($sql);
			foreach($usersToDelete as $index => $user)
			{
				$st->bindValue(($index + 1), $user);
			}
			$st->execute();

			$sql = "DELETE FROM rates WHERE id_user IN ($users)";
			$st = $db->prepare($sql);
			foreach($usersToDelete as $index => $user)
			{
				$st->bindValue(($index + 1), $user);
			}
			$st->execute();

			$sql = "DELETE FROM comments WHERE id_user IN ($users)";
			$st = $db->prepare($sql);
			foreach($usersToDelete as $index => $user)
			{
				$st->bindValue(($index + 1), $user);
			}
			$st->execute();

			$sql = "DELETE FROM watchlist WHERE id_user IN ($users)";
			$st = $db->prepare($sql);
			foreach($usersToDelete as $index => $user)
			{
				$st->bindValue(($index + 1), $user);
			}
			$st->execute();
		}
		catch(PDOException $e) { exit('PDO error ' . $e->getMessage()); }
	}

	function getUsersToDelete()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM users WHERE penalty > 3' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$rows = $st->fetchAll();
		$usersToDelete = array();

		foreach ($rows as $row) {
			$user = new User( $row['id_user'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'],
						$row['has_registered'], $row['is_admin'], $row['name'], $row['surname'], $row['date_of_birth'], $row['penalty']
			);

			$usersToDelete[] = $user;
		}

		return $usersToDelete;
	}

    function increasePenalty($id_user){

        $user = $this->getUserById($id_user);
        $new_penalty = $user->penalty;
        $new_penalty += 1;

        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET penalty = :new WHERE id_user = :id_user');
            $st->execute( array( 'id_user' => $id_user , 'new' => $new_penalty ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    }

};
?>
