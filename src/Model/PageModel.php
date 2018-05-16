<?php

/**
*
*/
class PageModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getTasks()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }
}

 ?>
