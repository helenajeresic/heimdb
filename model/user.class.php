<?php

class User {
    private $id;
    private $username;
    private $passwordHash;
    private $email;
    private $registrationSequence;
    private $hasRegistered;
    private $isAdmin;
    private $name;
    private $lastname;
    private $birthday;
    private $penalty;

    public function __construct() {}
    function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}
?>