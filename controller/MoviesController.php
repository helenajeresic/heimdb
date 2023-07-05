<?php

require_once __SITE_PATH . '/model/movies_service.class.php';
require_once __SITE_PATH .  '/model/movies.class.php';
require_once __SITE_PATH . '/model/comments_service.class.php';
require_once __SITE_PATH . '/model/users_service.class.php';
require_once __SITE_PATH . '/model/persons_service.class.php';
require_once __SITE_PATH . '/model/watchlist_service.class.php';
require_once __SITE_PATH . '/model/rates_service.class.php';

class moviesController extends BaseController {
    public function index()
    {
        $ms = new MovieService();
        $data = $ms->getAllMovies();

        $rs = new RatesService();
        $movieRatings = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->show_movies = $data;
        $this->registry->template->title = 'All movies';
        $this->registry->template->show('movies');
    }

    public function showUsersWatchlist()
    {

        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new WatchlistService();
            $rs = new RatesService();
            $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
            $movieRatings = array();
            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
            }
            $this->registry->template->show_movies = $data;
            $this->registry->template->ratings = $movieRatings;
            $this->registry->template->show('movies');
        }
    }

    public function showUsersWatched()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new WatchlistService();
            $rs = new RatesService();
            $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
            $movieRatings = array();

            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
            }
            $this->registry->template->show_movies = $data;
            $this->registry->template->ratings = $movieRatings;
            $this->registry->template->show('movies');
        }
    }

    public function addToWatchlist()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new WatchlistService();
            if(isset($_POST['id_movie'])) {
                $ms->addMovieToWatchlist( $_SESSION['id_user'], $_POST['id_movie'] );
                $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
            else {
                $ms = new WatchlistService();
                $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
        }
    }

    public function removeFromWatchlist()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new WatchlistService();
            if(isset($_POST['id_movie'])) {
                $ms->removeMovieFromWatchlist( $_SESSION['id_user'], $_POST['id_movie'] );
                $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
            else {
                $ms = new WatchlistService();
                $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
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
            $ms = new WatchlistService();
            if(isset($_POST['id_movie'])) {
                $ms->addWatchedMovie( $_SESSION['id_user'], $_POST['id_movie'] );
                $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
            else {
                $ms = new WatchlistService();
                $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
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
            $ms = new WatchlistService();
            if(isset($_POST['id_movie'])) {
                $ms->removeWatchedMovie( $_SESSION['id_user'], $_POST['id_movie'] );
                $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
            else {
                $ms = new WatchlistService();
                $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            }
        }
    }

    public function topRated()
    {
        $ms = new MovieService();
        
        $data = $ms->getTopRated();
        
        $rs = new RatesService();
        $movieRatings = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        $this->registry->template->show_movies = $data;
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->title = 'Top rated';
        $this->registry->template->show('movies');
    }

    public function mostWatched()
    {
        $ms = new MovieService();
        $data = $ms->getMostWatched();

        $rs = new RatesService();
        $movieRatings = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        $this->registry->template->show_movies = $data;
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->title = 'Most watched';
        $this->registry->template->show('movies');
    }

    public function mostPopular()
    {
        $ms = new MovieService();
        $data = $ms->getMostPopular();

        $rs = new RatesService();
        $movieRatings = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        $this->registry->template->show_movies = $data;
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->title = 'Most popular';
        $this->registry->template->show('movies');
    }

    public function addMovie()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                $ms = new MovieService();
                if( isset($_POST['id_movie']) && isset($_POST['title']) && isset($_POST['year']) &&
                isset($_POST['genre']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['duration'])){
                    $ms->addMovie($_POST['id_movie'], $_POST['title'], $_POST['year'], $_POST['genre'], $_POST['description'], $_POST['image'], $_POST['duration']);
                    header( 'Location: ' . __SITE_URL . '/index.php');
                }
                $this->registry->template->title = 'Add movie';
                $this->registry->template->error = false;
                $this->registry->template->show('upload_movie');
            }
            else {
                header( 'Location: ' . __SITE_URL . '/index.php');
            }
        }

    }

    public function showMovie() {
        $ms = new MovieService();
        $us = new UserService();
        $ps = new PersonService();
        $cs = new CommentService();
        if( isset( $_GET['id_movie'] )) {
            $id_movie = $_GET['id_movie'];
            $movie = $ms->getMovieById($id_movie);
            if($movie == false)
                exit( 'Krivi id filma.' );
            else
            {
                $comments = $cs->getMovieCommentsById($id_movie);
                $arr = [];
                foreach($comments as $comment)
                {
                    $arr[] = $us->getUserById($comment->__get('id_user'));
                }
                $recommendations = $ms->getMovieRecommendations();
                $actors = $ps->getActorsForMovie($id_movie);
                $directors = $ps->getDirectorsForMovie($id_movie);
                $this->registry->template->show_actors = $actors;
                $this->registry->template->show_directors = $directors;
                $this->registry->template->user_names = $arr;
                $this->registry->template->show_movie = $movie;
                $this->registry->template->show_comments = $comments;
                $this->registry->template->show_recommendations = $recommendations;
                $this->registry->template->show('movie');
            }
        }
        else {
            exit( 'Nesto ne valja sa id-em.' );
        }
    }

    public function search()
    {
        if( isset($_POST['search'] ) && $_POST['search'] !== ""   ){
            $s = $_POST['search'];
            $b = $_POST['by'];
            $ms = new MovieService();

            if ($b === '1') {
                $what = "title";
                $data = $ms->searchMovieByTitle($_POST['search']);
                $this->registry->template->show_movies = $data;
            }
            else if ($b === '2'){
                $what = "year";
                $data = $ms->searchMovieByYear($_POST['search']);
                $this->registry->template->show_movies = $data;
            }
            else{
                $what = "genre";
                $data = $ms->searchMovieByGenre($_POST['search']);
                $this->registry->template->show_movies = $data;
            }
            $title = "Search movies by " . $what . " : " . $_POST['search'];
            $this->registry->template->title = $title;
            $this->registry->template->show('movies');
        }
        else {
            header( 'Location: ' . __SITE_URL . '/index.php');
        }
    }




}
?>
