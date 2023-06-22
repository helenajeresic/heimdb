<?php

class User {
    private $id_user, $username, $passwordHash, $email, $registrationSequence;
    private $hasRegistered, $isAdmin, $name, $surname, $dateOfBirth, $penalty;

    public function __construct($id_user, $username, $passwordHash, $email, $registrationSequence,
                $hasRegistered, $isAdmin, $name, $surname, $dateOfBirth, $penalty)
    {
        $this->id_user = $id_user;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->email = $email;
        $this->registrationSequence = $registrationSequence;
        $this->hasRegistered = $hasRegistered;
        $this->isAdmin = $isAdmin;
        $this->name = $name;
        $this->surname = $surname;
        $this->dateOfBirth = $dateOfBirth;
        $this->penalty = $penalty;
    }
    function __get( $prop )
    { 
        return $this->$prop; 
    }
	function __set( $prop, $val )
    { 
        $this->$prop = $val; return $this; 
    }
}
?>