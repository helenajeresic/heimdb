<?php

require_once __SITE_PATH . '/model/users_service.class.php';

class usersController extends BaseController {
    public function index() 
    {}

    public function updateProfile() {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            //elena napisi
            $this->registry->template->title = 'Update profile';
            $this->registry->template->error = false;
            $this->registry->template->show('update_profile');
        }
    }
  
    public function deleteUser() {
        if(!isset($_SESSION['username'])) {
            $this->registry->template->title = 'Login';
            $this->registry->template->error = false;
            $this->registry->template->show('login');
        }
        else {
            if($_SESSION['admin'] == 1) {
                $us = new UserService();
                if(isset($_POST['lang'])) {
                    $selectedUsers = array();           
                    foreach($_POST['lang'] as $selected) {
                        $selectedUsers[] = $selected;
                    }
                    $us->deleteUsers($selectedUsers);
                }
                $delete =  $us->getUsersToDelete();
                $this->registry->template->title = 'Delete user';
                $this->registry->template->error = false;
                $this->registry->template->usersToDelete = $delete;
                $this->registry->template->show('delete_user');
            } 
            else {
                header( 'Location: ' . __SITE_URL . '/index.php');
            }          
        }
    }

}
?>