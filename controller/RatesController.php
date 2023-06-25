<?php

require_once __SITE_PATH . '/model/rates_service.class.php';
require_once __SITE_PATH . '/model/movies_service.class.php';

class ratesController extends BaseController {

    public function index()
    {}

    public function myRates()
    {

        if(!isset($_SESSION['username'])) {

            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $cs = new RatesService();
            $ms = new MovieService();
            $data = $cs->getRatesByUserId( $_SESSION['id_user'] );
            $this->registry->template->rates = $data;
            $arr = [];
            foreach ( $data as $rate ){
                $arr[] = $ms->getMovieById( $rate->__get('id_movie'));
            }
            $this->registry->template->movie_names = $arr;
            $this->registry->template->current_user = $_SESSION['username'];
            $this->registry->template->show('myRates');
        }
    }
}

?>
