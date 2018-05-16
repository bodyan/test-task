<?php

class AddController extends Controller
{

    public function __construct()
    {
        $this->model = new AddModel();
        $this->view = new View(getcwd().'/src/Views/MainTemplate.phtml');
    }

    public function indexAction(){
        if(isset($_POST) && count($_POST) > 0) {

            $data = [];
            $data['username'] = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
            $data['email'] = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
            $data['Task'] = filter_input(INPUT_POST,'Task', FILTER_SANITIZE_STRING);
            $data['taskImage'] = $_FILES['taskImage']["name"];

            if(!empty($data['username']) && !empty($data['email'])
                && !empty($data['Task']) && !empty($data['taskImage'])) {

                    $target_dir = "public/img/";
                    $target_file = $target_dir . basename($_FILES['taskImage']["name"]);
                    $image = new SimpleImage();
                    $image->load($_FILES['taskImage']['tmp_name']);
                    $image->resize(320, 240);
                    $image->save($target_file);

                    $this->model->addTask($data);
                    header("Location: /");
                    exit;
            } else {
                echo 'All fields required!';
                exit();
            }
        }

        $this->view->render('src/Views/AddTemplate.phtml');
    }
}

