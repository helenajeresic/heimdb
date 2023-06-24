<?php

require_once __SITE_PATH . '/model/comments_service.class.php';
require_once __SITE_PATH . '/model/movies_service.class.php';

class commentsController extends BaseController {
    public function index() 
    {}

    public function addNewComment() {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $ms = new MovieService();
            if( isset( $_GET['id_movie'] )) {
                $content = $_POST['comment-input'];
                $id_user = $_SESSION['id_user'];
                $id_movie = $_GET['id_movie'];
                $movie = $ms->getMovieById($id_movie);
                if($movie == false)
                    exit( 'Krivi id filma.' );
                else
                {   
                    $cs = new CommentService();
                    $cs->addComment($id_movie, $id_user, $content);
                    header( 'Location: ' . __SITE_URL . '/index.php?rt=movies/showMovie&id_movie=' . $id_movie);
                }
            }
            else {
                exit( 'Nesto ne valja sa id-em.' );
            }
        }
    }
}

