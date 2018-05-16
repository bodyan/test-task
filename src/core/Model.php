<?php

class Model {

    public $connection = null;

    function __construct()
    {
       $this->connect();
    }

    public function connect()
    {
        $this->connection = new PDO('sqlite:src/db/db.sqlite');
    }

}

 ?>
