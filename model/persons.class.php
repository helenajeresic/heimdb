<?php

class Person {
    private $id_person, $name, $surname;

    public function __construct($id_person, $name, $surname)
    {
        $this->id_person = $id_person;
        $this->name = $name;
        $this->surname = $surname;

    }
    function __get( $prop )
    {
        return $this->$prop;
    }
	function __set( $prop, $val )
    {
        $this->$prop = $val;
        return $this;
    }
}

 ?>
