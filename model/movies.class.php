<?php

class Movie {
    private $id_movie, $title, $year, $genre, $description;
    private $image, $duration;

    public function __construct($id_movie, $title, $year, $genre, $description, $image, $duration)
    {
        $this->id_movie = $id_movie;
        $this->title = $title;
        $this->year = $year;
        $this->genre = $genre;
        $this->description = $description;
        $this->image = $image;
        $this->duration = $duration;
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