<?php

require_once __SITE_PATH . '/model/comments_service.class.php';
require_once __SITE_PATH . '/model/movies_service.class.php';
require_once __SITE_PATH . '/model/users_service.class.php';

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
                    $cs->addComment($id_user, $id_movie, $content);
                    header( 'Location: ' . __SITE_URL . '/index.php?rt=movies/showMovie&id_movie=' . $id_movie);
                }
            }
            else {
                exit( 'Nesto ne valja sa id-em.' );
            }
        }
    }

      public function myComments()
    {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $this->registry->template->title = 'All my comments';
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

    public function deleteComment(){
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $cs = new CommentService();
            $ms = new MovieService();
            $us = new UserService();
            if( isset( $_GET['id_comment'] )) {
                $id_user = $_SESSION['id_user'];
                $id_comment = $_GET['id_comment'];
                $comment = $cs->getCommentsById($id_comment);
                if($comment == false)
                    exit( 'Krivi id komentara.' );
                else
                {
                    $id_comment_user = $comment->id_user;
                    $cs->removeComment($id_comment);
                    if($id_user !== $id_comment_user){
                        //to znaci da brisem komentar nekog drugog usera, pa mu trebam povecati penalty
                        $us->incresePenalty($id_comment_user);
                    }
                    header( 'Location: ' . __SITE_URL . '/index.php?rt=movies/showMovie&id_movie=' . $comment->id_movie);
                }
            }
            else {
                exit( 'Nesto ne valja sa id-em.' );
            }
        }
    }
    public function deleteMyComment(){
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            $cs = new CommentService();
            $ms = new MovieService();
            $us = new UserService();
            if( isset( $_GET['id_comment'] )) {
                $id_user = $_SESSION['id_user'];
                $id_comment = $_GET['id_comment'];
                $comment = $cs->getCommentsById($id_comment);
                if($comment == false)
                    exit( 'Krivi id komentara.' );
                else
                {
                    $id_comment_user = $comment->id_user;
                    $cs->removeComment($id_comment);
                    if($id_user !== $id_comment_user){
                        //to znaci da brisem komentar nekog drugog usera, pa mu trebam povecati penalty
                        $us->incresePenalty($id_comment_user);
                    }
                    header( 'Location: ' . __SITE_URL . '/index.php?rt=comments/myComments');
                }
            }
            else {
                exit( 'Nesto ne valja sa id-em.' );
            }
        }
    }
}
?>
