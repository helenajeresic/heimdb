<?php

class Comment {
    private $id_comment, $id_user, $id_movie, $content, $date;

    public function __construct($id_comment, $id_user, $id_movie, $content, $date)
    {
        $this->id_comment = $id_comment;
        $this->id_user = $id_user;
        $this->id_movie = $id_movie;
        $this->content = $content;
        $this->date = $date;
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