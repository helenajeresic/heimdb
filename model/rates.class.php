<?php

class Rate {
    private  $id_movie, $id_user, $rate, $date;

    public function __construct( $id_movie, $id_user, $rate, $date)
    {
        $this->id_user = $id_user;
        $this->id_movie = $id_movie;
        $this->rate = $rate;
        $this->date = $date;

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
