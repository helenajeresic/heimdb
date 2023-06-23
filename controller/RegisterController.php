<?php 

require_once __SITE_PATH .  '/model/userService.class.php';

class RegisterController extends BaseController
{
	public function index() 
	{
		$us = new UserService();
        if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) || !isset( $_POST['email']) )
        {
            $this->registry->template->title = 'You need to enter username, password and e-mail.';
			$this->registry->template->show( 'register' );
        }
        else if( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
        {
            $this->registry->template->title = 'E-mail is not valid.';
			$this->registry->template->show( 'register' );
        }
        else
        {
            $user = $us->getUserByUsername( $_POST['username'] );
            
            if( $user !== null )
            {
                $this->registry->template->title = 'User with that username already exists.';
                $this->registry->template->show( 'register' );
            }
            else
            {
                $reg_seq = '';
                for( $i = 0; $i < 20; ++$i )
                    $reg_seq .= chr( rand(0, 25) + ord( 'a' ) ); 

                $us->makeNewUser( $_POST['username'], $_POST['password'], $_POST['email'], $reg_seq, $_POST['name'], $_POST['surname']);

                $to       = $_POST['email'];
                $subject  = 'Registracijski mail';
                $message  = 'Poštovani ' . $_POST['username'] . "!\nZa dovršetak registracije kliknite na sljedeći link: ";
                $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=CompleteRegister&niz=' . $reg_seq . "\n";
                $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
                            'Reply-To: rp2@studenti.math.hr' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                $isOK = mail($to, $subject, $message, $headers);

                if( !$isOK )
                    exit( 'Greška: ne mogu poslati mail. (Pokrenite na rp2 serveru.)' );

                $this->registry->template->title = 'Thank you for your application.';
                $this->registry->template->show( 'application_thanks' );
            }
        }
    }
}
?>