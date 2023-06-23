<?php

require_once __SITE_PATH .  '/model/users_service.class.php';

class completeregisterController extends BaseController
{
	public function index()
	{
        $us = new UserService();

        if( !isset( $_GET['niz'] ) || !preg_match( '/^[a-z]{20}$/', $_GET['niz'] ) )
            exit( 'Nešto ne valja s nizom.' );
        else
        {
            $user = $us->getUserByRegSeq( $_GET['niz'] );

            if($user === false)
                exit( 'Taj registracijski niz ima vec neki od korisnika, a treba biti točno 1 takav.' );
            else
            {
                $this->registry->template->title = 'Thank you for your registration.';
                $this->registry->template->show( 'register_thanks' );
            }
        }
    }
}
?>
