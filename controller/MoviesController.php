<?php

class moviesController extends BaseController {
    public function index() {
        if(!isset($_SESSION["user"])) {
            $this->registry->template->title = "Login";
            $this->registry->template->error = false;
            $this->registry->template->show("login");
        }
        else {
            header('Location: ' . __SITE_URL . 'index.php?rt=movies');
        }
    }
}
?>