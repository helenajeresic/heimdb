<?php 

class IndexController extends BaseController
{
	public function index() 
	{
		if( isset($_SESSION['username']) )
			header( 'Location: ' . __SITE_URL . '/index.php?rt=movies' );
		else 
			header( 'Location: ' . __SITE_URL . '/index.php?rt=login' );
	}
}; 

?>