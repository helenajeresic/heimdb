<?php

require_once __SITE_PATH . '/model/comments_service.class.php';
require_once __SITE_PATH . '/model/movies_service.class.php';

class commentsController extends BaseController
{
    public function index()
    {

    }

    public function myComments()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $cs = new CommentService();
            $ms = new MovieService();
            $data = $cs->getCommentsByUserId( $_SESSION['id_user'] );
            $this->registry->template->comments = $data;
            $arr = [];
            foreach ( $data as $comment ){
                $arr[] = $ms->getMovieById( $comment->__get('id_movie'));
            }
            $this->registry->template->movie_names = $arr;
            $this->registry->template->current_user = $_SESSION['username'];
            $this->registry->template->show('myComments');
        }
    }
}

 ?>
