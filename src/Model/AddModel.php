<?php

class AddModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function DefaultAction()
    {
        echo 'OK';
    }

    public function addTask($data)
    {

        $data = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':text' => $data['Task'],
            ':img_name' => $data['taskImage'],
            ':status' => 'incomplete'
        ];
        $query = $this->connection->prepare(
                "INSERT INTO tasks (
                    username, email, text, img_real_name, status
                ) VALUES (
                    :username, :email, :text, :img_name, :status
                )"
        );
        $query->execute($data);
    }

}

?>
