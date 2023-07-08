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

    public function updateWatchlist()
    {
        if (isset($_POST['id_movie']) && isset($_POST['status'])) {
            $movieId = $_POST['id_movie'];
            $status = $_POST['status'];
    
            // Provjerite je li korisnik prijavljen
            if (!isset($_SESSION['username'])) {
                $response = ['status' => 'error', 'message' => 'User not logged in'];
                echo json_encode($response);
                return;
            }
    
            $userId = $_SESSION['id_user'];
    
            try {
                $watchlistService = new WatchlistService();
                if ($status == 1) {
                    // Dodaj film na watchlist
                    $watchlistService->addMovieToWatchlist($userId, $movieId);
                } else {
                    // Ukloni film s watchliste
                    $watchlistService->removeMovieFromWatchlist($userId, $movieId);
                }
    
                $response = ['status' => 'success', 'message' => 'Watchlist updated successfully'];
                echo json_encode($response);
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Error updating watchlist'];
                echo json_encode($response);
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Invalid request'];
            echo json_encode($response);
        }
    }
    
    

    //Addsmovie to watched movies and removes it from watchlist list.
    //kako updateati?
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

    //imapuno toga za updateati
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
}

?>
