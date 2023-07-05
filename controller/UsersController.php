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
            $us = new UserService();

            if( isset($_POST['name']) && $_POST['name'] !== ''){
    			$us->updateName($_SESSION['username'], $_POST['name']);
    		}
    		if( isset($_POST['surname']) && $_POST['surname'] !== ''){
    			$us->updateSurname($_SESSION['username'], $_POST['surname']);
    		}
    		if( isset($_POST['email']) && $_POST['email'] !== ''){
    			$us->updateEmail($_SESSION['username'], $_POST['email']);
    		}
    		if( isset($_POST['date']) && $_POST['date'] !== ''){
    			$us->updateDate($_SESSION['username'], $_POST['date']);
    		}

            $userData = $us->getUserByUsername($_SESSION['username']);
            $this->registry->template->data = $userData;
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
            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
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
