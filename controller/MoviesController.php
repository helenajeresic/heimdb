<?php

require_once __SITE_PATH . '/model/movies_service.class.php';

class moviesController extends BaseController {
    public function index() {
        if(!isset($_SESSION["username"])) {
            $this->registry->template->title = "Login";
            $this->registry->template->error = false;
            $this->registry->template->show("login");
        }
        else {
            $ms = new MovieService();
            $data = $ms->getAllMovies();
            $this->registry->template->show_movies = $data;
            $this->registry->template->show("movies");
        }
    }
}
?>
