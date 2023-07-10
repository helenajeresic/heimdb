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
        if( !isset($_SESSION['username']) ){
            $ms = new MovieService();
            $data = $ms->getAllMovies();

            $rs = new RatesService();
            $movieRatings = array();
            $watchlist = array();
            $watched = array();

            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
                $watchlist[$id_movie] = false;
                $watched[$id_movie] = false;
            }

            $this->registry->template->movieOnWatchlist = $watchlist;
            $this->registry->template->movieOnWatched = $watched;
            $this->registry->template->ratings = $movieRatings;
            $this->registry->template->show_movies = $data;
            $this->registry->template->title = 'All movies';
            $this->registry->template->show('movies');
        } else {
            $ms = new MovieService();
            $data = $ms->getAllMovies();

            $rs = new RatesService();
            $movieRatings = array();

            $ws = new WatchlistService();
            $watchlist = array();
            $watched = array();

            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                $username = $_SESSION['username'];
                $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }

            $this->registry->template->movieOnWatchlist = $watchlist;
            $this->registry->template->movieOnWatched = $watched;
            $this->registry->template->ratings = $movieRatings;
            $this->registry->template->show_movies = $data;
            $this->registry->template->title = 'All movies';
            $this->registry->template->show('movies');

        }
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
            $watchlist = array();
            $watched = array();
            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                $isOnWatchlist = $ms->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ms->checkWatched( $id_movie, $_SESSION['id_user'] );
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }
            $this->registry->template->show_movies = $data;
            $this->registry->template->ratings = $movieRatings;
            $this->registry->template->movieOnWatchlist = $watchlist;
            $this->registry->template->movieOnWatched = $watched;
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
            $watchlist = array();
            $watched = array();

            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                $isOnWatchlist = $ms->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ms->checkWatched( $id_movie, $_SESSION['id_user'] );
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }
            $this->registry->template->show_movies = $data;
            $this->registry->template->ratings = $movieRatings;
            $this->registry->template->movieOnWatchlist = $watchlist;
            $this->registry->template->movieOnWatched = $watched;
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

        $ws = new WatchlistService();
        $watchlist = array();
        $watched = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if(isset($_SESSION['id_user'])) {
                $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        $this->registry->template->disabled = false;
        $this->registry->template->show_movies = $data;
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->movieOnWatchlist = $watchlist;
        $this->registry->template->movieOnWatched = $watched;
        $this->registry->template->title = 'Top rated';
        $this->registry->template->show('movies');
        
    }

    public function mostWatched()
    {

        $ms = new MovieService();
        $data = $ms->getMostWatched();

        $rs = new RatesService();
        $movieRatings = array();

        $ws = new WatchlistService();
        $watchlist = array();
        $watched = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if(isset($_SESSION['id_user'])) {
                $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        $this->registry->template->disabled = false;
        $this->registry->template->show_movies = $data;
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->movieOnWatchlist = $watchlist;
        $this->registry->template->movieOnWatched = $watched;
        $this->registry->template->title = 'Most watched';
        $this->registry->template->show('movies');
        
    }

    public function mostPopular()
    {

        $ms = new MovieService();
        $data = $ms->getMostPopular();

        $rs = new RatesService();
        $movieRatings = array();

        $ws = new WatchlistService();
        $watchlist = array();
        $watched = array();

        foreach( $data as $movie) {
            $id_movie = $movie->__get('id_movie');
            $averageRating = $rs->getAverageRating( $id_movie );
            if(isset($_SESSION['id_user'])) {
                $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }
            if($averageRating !== null){
                $movieRatings[$id_movie] = $averageRating;
            } else {
                $movieRatings[$id_movie] = 0;
            }
        }

        $this->registry->template->disabled = false;
        $this->registry->template->show_movies = $data;
        $this->registry->template->ratings = $movieRatings;
        $this->registry->template->movieOnWatchlist = $watchlist;
        $this->registry->template->movieOnWatched = $watched;
        $this->registry->template->title = 'Most popular';
        $this->registry->template->show('movies');
        
    }

    public function addMovie()
    {
        if(!isset($_SESSION['username']))
        {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else
        {
            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            {
                $ms = new MovieService();
                if (isset($_POST['title']) && isset($_POST['year']) &&
                isset($_POST['genre']) && isset($_POST['description']) && isset($_FILES['image']) &&
                isset($_POST['duration']) && isset($_POST['dir-name-1']) && isset($_POST['dir-surname-1']) &&
                isset($_POST['act-name-1']) && isset($_POST['act-surname-1']) &&
                !empty($_POST['title']) && !empty($_POST['year']) &&
                !empty($_POST['description']) && !empty($_POST['duration']) &&
                !empty($_POST['dir-name-1']) && !empty($_POST['dir-surname-1']) &&
                !empty($_POST['act-name-1']) && !empty($_POST['act-surname-1']))
                {
                    //pokupi sve zanrove
                    $selectedGenres = $_POST['genre'];

                    if (is_array($selectedGenres))
                        $genreString = implode(' ', $selectedGenres);
                    else
                        $genreString = $selectedGenres;

                    //pokupi sve redatelje
                    $directorNames = array();
                    $directorSurnames = array();

                    $directorNames[] = $_POST['dir-name-1'];
                    $directorSurnames[] = $_POST['dir-surname-1'];

                    if (isset($_POST['dir-name-2']) && isset($_POST['dir-surname-2']) &&
                    !empty($_POST['dir-name-2']) && !empty($_POST['dir-surname-2']))
                    {
                        $directorNames[] = $_POST['dir-name-2'];
                        $directorSurnames[] = $_POST['dir-surname-2'];
                    }

                    if (isset($_POST['dir-name-3']) && isset($_POST['dir-surname-3']) &&
                    !empty($_POST['dir-name-3']) && !empty($_POST['dir-surname-3']))
                    {
                        $directorNames[] = $_POST['dir-name-3'];
                        $directorSurnames[] = $_POST['dir-surname-3'];
                    }

                    //pokupi sve glumce
                    $actorNames = array();
                    $actorSurnames = array();

                    $actorNames[] = $_POST['act-name-1'];
                    $actorSurnames[] = $_POST['act-surname-1'];

                    if (isset($_POST['act-name-2']) && isset($_POST['act-surname-2']) &&
                    !empty($_POST['act-name-2']) && !empty($_POST['act-surname-2']))
                    {
                        $actorNames[] = $_POST['act-name-2'];
                        $actorSurnames[] = $_POST['act-surname-2'];
                    }

                    if (isset($_POST['act-name-3']) && isset($_POST['act-surname-3']) &&
                    !empty($_POST['act-name-3']) && !empty($_POST['act-surname-3']))
                    {
                        $actorNames[] = $_POST['act-name-3'];
                        $actorSurnames[] = $_POST['act-surname-3'];
                    }

                    $ms->addMovie( $_POST['title'], $_POST['year'], $genreString, $_POST['description'], $_FILES['image']['name'], $_FILES['image']['tmp_name'], $_POST['duration'], $directorNames, $directorSurnames, $actorNames, $actorSurnames);
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

    public function showMovie() 
    {
        $ms = new MovieService();
        $us = new UserService();
        $ps = new PersonService();
        $cs = new CommentService();
        $rs = new RatesService();
        $ws = new WatchlistService();
        $watchlist = array();
        $watched = array();
        if( isset( $_GET['id_movie'] )) {
            $id_movie = $_GET['id_movie'];
            $movie = $ms->getMovieById($id_movie);
            if(isset($_SESSION['id_user'])) {
                $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                $watchlist[$id_movie] = $isOnWatchlist;
                $watched[$id_movie] = $isOnWatched;
            }
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
                $rating = $rs->getAverageRating($id_movie);
                $this->registry->template->rating = $rating;
                $this->registry->template->show_actors = $actors;
                $this->registry->template->show_directors = $directors;
                $this->registry->template->user_names = $arr;
                $this->registry->template->show_movie = $movie;
                $this->registry->template->show_comments = $comments;
                $this->registry->template->movieOnWatchlist = $watchlist;
                $this->registry->template->movieOnWatched = $watched;
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


            $rs = new RatesService();
            $movieRatings = array();

            $ws = new WatchlistService();
            $watchlist = array();
            $watched = array();

            foreach( $data as $movie) {
                $id_movie = $movie->__get('id_movie');
                $averageRating = $rs->getAverageRating( $id_movie );
                if(isset($_SESSION['id_user'])) {
                    $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                    $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                    $watchlist[$id_movie] = $isOnWatchlist;
                    $watched[$id_movie] = $isOnWatched;
                }
                if($averageRating !== null){
                    $movieRatings[$id_movie] = $averageRating;
                } else {
                    $movieRatings[$id_movie] = 0;
                }
            }

            //tu obrisati?
            if(!isset($_SESSION['username'])){
                $this->registry->template->disabled = true;
            } else {
                $this->registry->template->disabled = false;
            }
            $this->registry->template->ratings = $movieRatings;
            $title = "Search result: ";
            $subtitle = "Search movies by " . $what . " : " . $_POST['search'];
            $this->registry->template->title = $title;
            $this->registry->template->subtitle = $subtitle;
            $this->registry->template->movieOnWatchlist = $watchlist;
            $this->registry->template->movieOnWatched = $watched;
            $this->registry->template->show('search');
        }
        else {
            header( 'Location: ' . __SITE_URL . '/index.php');
        }
    }


    public function rateMovie() {
        if(!isset($_SESSION['id_user'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            if( isset( $_POST['rating'] ) && isset( $_GET['id_movie'] )) {
                $id_user = $_SESSION['id_user'];
                $id_movie = $_GET['id_movie'];
                $movie = $ms->getMovieById($id_movie);
                if($movie == false)
                    exit( 'Krivi id filma.' );
                else
                {
                    $rs = new RatesService();
                    $rs->insertOrUpdateRating( $id_movie, $id_user, $_POST['rating']);
                    header( 'Location: ' . __SITE_URL . '/index.php');
                }
            }
            else {
                exit( 'Nesto ne valja sa id-em.' );
            }
        }
    }

    public function rateMovieOnMovie() {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            if( isset( $_POST['rating'] ) && isset( $_GET['id_movie'] )) {
                $id_user = $_SESSION['id_user'];
                $id_movie = $_GET['id_movie'];
                $movie = $ms->getMovieById($id_movie);
                if($movie == false)
                    exit( 'Krivi id filma.' );
                else
                {
                    $rs = new RatesService();
                    $rs->insertOrUpdateRating( $id_movie, $id_user, $_POST['rating']);
                    header( 'Location: ' . __SITE_URL . '/index.php?rt=movies/showMovie&id_movie=' . $id_movie);
                }
            }
            else {
                exit( 'Nesto ne valja sa id-em.' );
            }
        }
    }

    public function sortData($dataArray, $sortCondition, $orderCondition)
    {
    
        usort($dataArray, function($a, $b) use ($sortCondition, $orderCondition) {
            switch ($sortCondition) {
                case 'TITLE':
                    return (strcmp($a->__get('title'), $b->__get('title')) <=> 0) * ($orderCondition === 'asc' ? 1 : -1);
                case 'YEAR':
                    return ($a->__get('year') <=> $b->__get('year')) * ($orderCondition === 'asc' ? 1 : -1);
                case 'GENRE':
                    return (strcmp($a->__get('genre') , $b->__get('genre')) <=> 0) * ($orderCondition === 'asc' ? 1 : -1);
                case 'RATING':
                    $rs = new RatesService();
                    $ratingA = $rs->getAverageRating($a->__get('id_movie'));
                    $ratingB = $rs->getAverageRating($b->__get('id_movie'));
                    return ($ratingA <=> $ratingB) * ($orderCondition === 'asc' ? 1 : -1);
            }
        });
    
        return $dataArray;
    }
    
    

    public function sortMovie()
    {
        if( !isset($_SESSION['username']) ) {
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $selectedSort = $_POST['selectSort'];
                $selectedOrder = $_POST['orderSort'];
                $uri_title = $_POST['currentPage'];
                $currentSort = $_POST['currentSort'];
                $currentOrder = $_POST['currentOrder'];

                $ms = new MovieService();
                if( $uri_title === 'Top rated' ){
                    $data = $ms->getTopRated();
                    $this->registry->template->title = 'Top rated';
                } elseif( $uri_title === 'Most watched' ){
                    $data = $ms->getMostWatched();
                    $this->registry->template->title = 'Most watched';
                } elseif( $uri_title === 'Most popular' ){
                    $data = $ms->getMostPopular();
                    $this->registry->template->title = 'Most popular';
                } elseif( $uri_title === 'All movies' ) {
                    $data = $ms->getAllMovies();
                    $this->registry->template->title = 'All movies';
                } else {
                    $data = $ms->getAllMovies();
                    $this->registry->template->title = 'Error in sorting. All movies:';
                }

                $sortedData = $this->sortData( $data, $selectedSort, $selectedOrder);
                
                $ms = new MovieService();
                $rs = new RatesService();
                $movieRatings = array();
                $watchlist = array();
                $watched = array();
    
                foreach( $sortedData as $movie) {
                    $id_movie = $movie->__get('id_movie');
                    $averageRating = $rs->getAverageRating( $id_movie );
                    if($averageRating !== null){
                        $movieRatings[$id_movie] = $averageRating;
                    } else {
                        $movieRatings[$id_movie] = 0;
                    }
                    $watchlist[$id_movie] = false;
                    $watched[$id_movie] = false;
                }
    
                $this->registry->template->order = $selectedOrder;
                $this->registry->template->sort = $selectedSort;
                $this->registry->template->movieOnWatchlist = $watchlist;
                $this->registry->template->movieOnWatched = $watched;
                $this->registry->template->ratings = $movieRatings;
                $this->registry->template->show_movies = $sortedData;
                $this->registry->template->show('movies');

            } else{
                exit('Error on sort');
            }

        } else {
        
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $selectedSort = $_POST['selectSort'];
                $selectedOrder = $_POST['orderSort'];
                $uri_title = $_POST['currentPage'];
                $currentSort = $_POST['currentSort'];
                $currentOrder = $_POST['currentOrder'];

                $ms = new MovieService();
                if( $uri_title === 'Top rated' ){
                    $data = $ms->getTopRated();
                    $this->registry->template->title = 'Top rated';
                } elseif( $uri_title === 'Most watched' ){
                    $data = $ms->getMostWatched();
                    $this->registry->template->title = 'Most watched';
                } elseif( $uri_title === 'Most popular' ){
                    $data = $ms->getMostPopular();
                    $this->registry->template->title = 'Most popular';
                } elseif( $uri_title === 'All movies' ) {
                    $data = $ms->getAllMovies();
                    $this->registry->template->title = 'All movies';
                } else {
                    $data = $ms->getAllMovies();
                    $this->registry->template->title = 'Error in sorting. All movies:';
                }

                $sortedData = $this->sortData( $data, $selectedSort, $selectedOrder);

                $ms = new MovieService();
                $rs = new RatesService();
                $ws = new WatchlistService();
                $movieRatings = array();
                $watchlist = array();
                $watched = array();
    
                foreach( $sortedData as $movie) {
                    $id_movie = $movie->__get('id_movie');
                    $averageRating = $rs->getAverageRating( $id_movie );
                    $isOnWatchlist = $ws->checkWatchlist( $id_movie, $_SESSION['id_user'] );
                    $isOnWatched = $ws->checkWatched( $id_movie, $_SESSION['id_user'] );
                    if($averageRating !== null){
                        $movieRatings[$id_movie] = $averageRating;
                    } else {
                        $movieRatings[$id_movie] = 0;
                    }
                    $watchlist[$id_movie] = $isOnWatchlist;
                    $watched[$id_movie] = $isOnWatched;
                }
    
                $this->registry->template->order = $selectedOrder;
                $this->registry->template->sort = $selectedSort;
                $this->registry->template->movieOnWatchlist = $watchlist;
                $this->registry->template->movieOnWatched = $watched;
                $this->registry->template->ratings = $movieRatings;
                $this->registry->template->show_movies = $sortedData;
                $this->registry->template->show('movies');

            } else{
                exit('Error on sort');
            }
        }
    }
}
?>