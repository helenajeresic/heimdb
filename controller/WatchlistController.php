<?php

require_once __SITE_PATH . '/model/movies.class.php';
require_once __SITE_PATH . '/model/movies_service.class.php';
require_once __SITE_PATH . '/model/watchlist_service.class.php';
require_once __SITE_PATH . '/model/rates_service.class.php';

class watchlistController extends BaseController
{
    public function index()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new WatchlistService();
            $dataWatchlist = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
            $dataWatched = $ms->getWatchedMoviesById( $_SESSION['id_user'] );

            $rs = new RatesService();
            $movieRatingsWatchlist = array();

            foreach( $dataWatchlist as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRatingWatchlist = $rs->getAverageRating( $id_movie );
                if($averageRatingWatchlist !== null){
                    $movieRatingsWatchlist[$id_movie] = $averageRatingWatchlist;
                } else {
                    $movieRatingsWatchlist[$id_movie] = 0;
                }
            }

            $movieRatingsWatched = array();

            foreach( $dataWatched as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRatingWatched = $rs->getAverageRating( $id_movie );
                if($averageRatingWatched !== null){
                    $movieRatingsWatched[$id_movie] = $averageRatingWatched;
                } else {
                    $movieRatingsWatched[$id_movie] = 0;
                }
            }

            $this->registry->template->show_watchlist = $dataWatchlist;
            $this->registry->template->show_watched = $dataWatched;
            $this->registry->template->ratings_watchlist = $movieRatingsWatchlist;
            $this->registry->template->ratings_watched = $movieRatingsWatched;
            $this->registry->template->title = 'Watchlist';
            $this->registry->template->show('watchlist');
        }
    }

    public function addToWatched()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            if(isset($_POST['id_movie'])) {
                $ms = new WatchlistService();
                $ms->addWatchedMovie( $_SESSION['id_user'], $_POST['id_movie'] );
                $ms->removeFromWatchlist( $_SESSION['id_user'], $_POST['id_movie'] );
                $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );

                $this->registry->template->show_movies = $data;
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('watchlist');

                $response = ['status' => 'success', 'message' => 'Movie added to watched'];
                echo json_encode($response);
            }
            else {
                $ms = new WatchlistService();
                $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('watchlist');
            }
        }
    }

    public function removeFromWatched()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            if(isset($_POST['id_movie'])) {
                $ms = new WatchlistService();
                $ms->removeWatchedMovie( $_SESSION['id_user'], $_POST['id_movie'] );
                $ms->addToWatchlist($_POST['id_movie'] );

                $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
                $this->registry->template->show_watchlist = $data;
                $this->registry->template->show('watchlist');

                $response = ['status' => 'success', 'message' => 'Movie removed from watched'];
                echo json_encode($response);
            }
            else {
                $ms = new WatchlistService();
                $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('watchlist');
            }
        }
    }

    function updateWatchlist()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            if( isset($_POST['id_movie'])){
                $ms = new WatchlistService();
                $id_movie = $_POST['id_movie'];
                $id_user = $_SESSION['id_user'];
        
                if( $ms->checkWatchlist($id_movie, $id_user) ){
                    $ms->removeMovieFromWatchlist($id_user, $id_movie );
                } else {
                    $ms->addMovieToWatchlist( $id_user, $id_movie);
                }
            }

            $ws = new WatchlistService();
            $dataWatchlist = $ws->getUsersWatchlistById( $_SESSION['id_user'] );
            $dataWatched = $ws->getWatchedMoviesById( $_SESSION['id_user'] );


            $rs = new RatesService();
            $movieRatingsWatchlist = array();

            foreach( $dataWatchlist as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRatingWatchlist = $rs->getAverageRating( $id_movie );
                if($averageRatingWatchlist !== null){
                    $movieRatingsWatchlist[$id_movie] = $averageRatingWatchlist;
                } else {
                    $movieRatingsWatchlist[$id_movie] = 0;
                }
            }

            $movieRatingsWatched = array();

            foreach( $dataWatched as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRatingWatched = $rs->getAverageRating( $id_movie );
                if($averageRatingWatched !== null){
                    $movieRatingsWatched[$id_movie] = $averageRatingWatched;
                } else {
                    $movieRatingsWatched[$id_movie] = 0;
                }
            }

            $this->registry->template->show_watchlist = $dataWatchlist;
            $this->registry->template->show_watched = $dataWatched;
            $this->registry->template->ratings_watchlist = $movieRatingsWatchlist;
            $this->registry->template->ratings_watched = $movieRatingsWatched;
            $this->registry->template->title = 'Watchlist';
            $this->registry->template->show('watchlist');
        }
    }

    function updateWatched()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            if( isset($_POST['id_movie']) ){
                $ms = new WatchlistService();
                $id_movie = $_POST['id_movie'];
                $id_user = $_SESSION['id_user'];
        
                if( $ms->checkWatched($id_movie, $id_user) ){
                    $ms->removeWatchedMovie($id_user, $id_movie );
                } else {
                    if( $ms->checkWatchlist( $id_movie, $id_user ) ){
                        $ms->updateWatchedMovie( $id_user, $id_movie);
                    } else{
                        $ms->addWatchedMovie( $id_user, $id_movie);
                    }
                }
            }
            
            $ws = new WatchlistService();
            $dataWatchlist = $ws->getUsersWatchlistById( $_SESSION['id_user'] );
            $dataWatched = $ws->getWatchedMoviesById( $_SESSION['id_user'] );


            $rs = new RatesService();
            $movieRatingsWatchlist = array();

            foreach( $dataWatchlist as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRatingWatchlist = $rs->getAverageRating( $id_movie );
                if($averageRatingWatchlist !== null){
                    $movieRatingsWatchlist[$id_movie] = $averageRatingWatchlist;
                } else {
                    $movieRatingsWatchlist[$id_movie] = 0;
                }
            }

            $movieRatingsWatched = array();

            foreach( $dataWatched as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRatingWatched = $rs->getAverageRating( $id_movie );
                if($averageRatingWatched !== null){
                    $movieRatingsWatched[$id_movie] = $averageRatingWatched;
                } else {
                    $movieRatingsWatched[$id_movie] = 0;
                }
            }

            $this->registry->template->show_watchlist = $dataWatchlist;
            $this->registry->template->show_watched = $dataWatched;
            $this->registry->template->ratings_watchlist = $movieRatingsWatchlist;
            $this->registry->template->ratings_watched = $movieRatingsWatched;
            $this->registry->template->title = 'Watchlist';
            $this->registry->template->show('watchlist');
        }
    }

}

?>
