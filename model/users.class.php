<?php

class User {
    private $id;
    private $username;
    private $password_hash;
    private $email;
    private $registration_sequence;
    private $has_registered;
    private $is_admin;
    private $name;
    private $surname;
    private $date_of_birth;
    private $penalty;

    public function __construct($id, $username, $password_hash, $email, $registration_sequence, $has_registered, $is_admin, $name, $surname, $date_of_birth, $penalty) 
    {
        $this->id = $id;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->email = $email;
        $this->registration_sequence = $registration_sequence;
        $this->has_registered = $has_registered;
        $this->is_admin = $is_admin;
        $this->name = $name;
        $this->surname = $surname;
        $this->date_of_birth = $date_of_birth;
        $this->penalty = $penalty;
    }
    function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}
?>