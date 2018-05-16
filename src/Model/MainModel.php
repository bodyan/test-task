<?php

/**
*
*/
class MainModel extends Model
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

    public function getTaskById($id)
    {
        $data = [':id' => $id];

        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       WHERE id = :id"
            );
        $query->execute($data);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function getTaskByName($username)
    {
        $data = [':username' => $username];

        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       WHERE id = :username"
            );
        $query->execute($data);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function sortByUsersAsc()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       ORDER BY username ASC"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function sortByUsersDesc()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       ORDER BY username DESC"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function sortByEmailAsc()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       ORDER BY email ASC"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function sortByEmailDesc()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       ORDER BY email DESC"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function sortByStatusAsc()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       ORDER BY status ASC"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function sortByStatusDesc()
    {
        $query = $this->connection
            ->prepare("SELECT
                       id, status, username, email, text, img_real_name
                       FROM tasks
                       ORDER BY status DESC"
            );
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

}

 ?>
