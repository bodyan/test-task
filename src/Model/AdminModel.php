<?php

/**
*
*/
class AdminModel extends Model
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
        $result = $query->fetch();
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

    public function editTask($input)
    {
        if (!is_array($input)) {
          exit('Not valid data for editing!');
        }

        $data = [':username' => $input['username'],
                 ':email' => $input['email'],
                 ':task' => $input['Task'],
                 ':id' => $input['id'],
                 ':status' => $input['status']
        ];

        $query = $this->connection
            ->prepare("UPDATE tasks
                       SET username = :username,
                           email = :email,
                           text = :task,
                           status = :status
                       WHERE id = :id"
            );
        $query->execute($data);
        header("Location: /admin/show");
        exit();
    }

    public function loginAdmin($input)
    {
      $pass = MD5($input['password']);
      $data = [':username' => $input['username'],
               ':password' => $pass
        ];
      $query = $this->connection
            ->prepare("SELECT id
                       FROM users
                       WHERE username = :username
                       AND password = :password"
      );
        $query->execute($data);
        $result = $query->fetchAll();
        $count = count($result);
        return $count;
    }
}

 ?>
