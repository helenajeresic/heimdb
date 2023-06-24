<?php

require_once __SITE_PATH . '/model/movies_service.class.php';
require_once __SITE_PATH . '/model/users_service.class.php';
require_once __SITE_PATH . '/model/persons_service.class.php';
require_once __SITE_PATH . '/model/watchlist_service.class.php';

class moviesController extends BaseController {
    public function index() 
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            $data = $ms->getAllMovies();
            $this->registry->template->show_movies = $data;
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
            $data = $ms->getUsersWatchlistById( $_SESSION['id_user'] );
            $this->registry->template->show_movies = $data;
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
            $data = $ms->getWatchedMoviesById( $_SESSION['id_user'] );
            $this->registry->template->show_movies = $data;
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
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            $data = $ms->getTopRated();
            $this->registry->template->show_movies = $data;
            $this->registry->template->show('movies');
        }   
    }

    public function mostWatched()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            $data = $ms->getMostWatched();
            $this->registry->template->show_movies = $data;
            $this->registry->template->show('movies');
        }  
    }

    public function mostPopular()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            $data = $ms->getMostPopular();
            $this->registry->template->show_movies = $data;
            $this->registry->template->show('movies');
        }  
    }

    public function addMovie()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            if( isset($_POST['id_movie']) && isset($_POST['title']) && isset($_POST['year']) &&
                isset($_POST['genre']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['duration'])){
                $data = $ms->getMostPopular();

                $this->registry->template->show_movies = $data;
                $this->registry->template->show('movies');
            } 
            else {

            }
        }  
    }

    public function showMovie() {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            $us = new UserService();
            $ps = new PersonService();
            if( isset( $_GET['id_movie'] )) {
                $id_movie = $_GET['id_movie'];
                $movie = $ms->getMovieById($id_movie);
                if($movie == false)
                    exit( 'Krivi id filma.' );
                else
                {   
                    $comments = $ms->getMovieCommentsById($id_movie);
                    $arr = [];
                    foreach($comments as $comment)
                    {
                        $arr[] = $us->getUserById($comment->__get('id_user'));
                    }
                    $recommendations = $ms->getMovieRecommendations();
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
    }

}
?>
