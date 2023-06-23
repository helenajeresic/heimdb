<?php

require_once __SITE_PATH .  '/model/users_service.class.php';

class LoginController extends BaseController
{
	public function index()
	{

		$us = new UserService();

		if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) )
		{
			$this->registry->template->title = 'Enter your username and password.';
			$this->registry->template->show( 'login' );
		}
		else
		{
			$user = $us->getUserByUsername( $_POST['username'] );

			if( $user === null )
			{
				$this->registry->template->title = 'User with this username does not exist.';
				$this->registry->template->show( 'login' );
			}
			else if( $user->has_registered === '0' )
			{
				$this->registry->template->title = 'The user with this e-mail is not registered. Check your email.';
				$this->registry->template->show( 'login' );
			}
			else if( !password_verify( $_POST['password'], $user->password_hash ) )
			{
				$this->registry->template->title = 'Incorrect password.';
				$this->registry->template->show( 'login' );
			}
			else
			{
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['id_user'] = $user -> id_user;
				$_SESSION['name'] = $user -> name;
				$_SESSION['surname'] = $user -> surname;
				$_SESSION['admin'] = $user -> is_admin;


				header( 'Location: ' . __SITE_URL . '/index.php?rt=movies' );
			}
		}
	}

};

?>
