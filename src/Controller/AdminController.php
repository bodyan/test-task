<?php

class AdminController extends Controller
{

    public $tasksPerPage = 3;

    public function __construct()
    {
        $this->model = new AdminModel();
        $this->view = new View(getcwd().'/src/Views/MainAdminTemplate.phtml');
        Session::start();


    }

    public function indexAction()
    {
        if(Session::get('loggedIn') == false) {
            Session::destroy();
            $this->view->render('src/Views/LoginAdminTemplate.phtml');
        } else {
            $this->showAction();
        }

    }

    public function loginAction()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $data = [];
            $data['username'] = filter_input(INPUT_POST,'login', FILTER_SANITIZE_STRING);
            $data['password'] = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
            $count = $this->model->loginAdmin($data);
            if($count == 1) {

                 Session::set('loggedIn', true);
                 $this->showAction();
            } else {
                 header("Location: ../admin");
            }
        }
    }

    public function logoutAction()
    {
        Session::destroy();
        header("Location: ../admin");
        exit();
    }

    public function countPage()
    {
        $countTasks = count($this->model->getTasks());
        $numOfPages = $countTasks / $this->tasksPerPage;
        $numOfPages = (!is_float($numOfPages)) ? $numOfPages : intval($numOfPages+1);
        return $numOfPages;
    }

    public function showAction($input = null)
    {
         if(Session::get('loggedIn') == false) {
            Session::destroy();
            header("Location: ../admin");
        }
        $pagination['pages'] = $this->countPage();
        $page = (!empty($input['page']) && $input['page'] <= $pagination['pages']) ? $input['page'] : 1;
        $order = (!empty($input['order'])) ? $input['order'] : '';

        switch ($order) {
            case 'user':
                $get_tasks = $this->model->sortByUsersAsc();
                break;
            case 'userdesc':
                $get_tasks = $this->model->sortByUsersDesc();
                break;
            case 'email':
                $get_tasks = $this->model->sortByEmailAsc();
                break;
            case 'emaildesc':
                $get_tasks = $this->model->sortByEmailDesc();
                break;
            case 'status':
                $get_tasks = $this->model->sortByStatusAsc();
                break;
            case 'statusdesc':
                $get_tasks = $this->model->sortByStatusDesc();
                break;
            default:
                $get_tasks = $this->model->getTasks();
                break;
        }

        $start = $page*$this->tasksPerPage-$this->tasksPerPage;
        $tasks = array_slice($get_tasks, $start, $this->tasksPerPage);
        if($order == 'user' || $order == 'status' || $order == 'email') {

        }

        $pagination['page'] = $page;

        $this->view->render('src/Views/AdminTemplate.phtml', [
            'tasks' => $tasks,
            'pagination' => $pagination,
            'order' => $order
            ]);
    }

    public function editAction($id)
    {
        $tasks = $this->model->getTaskById($id['id']);

        $this->view->render('src/Views/EditAdminTemplate.phtml', ['task' => $tasks]);
    }

    public function edit2Action()
    {
        $data = [];
        $data['id'] = filter_input(INPUT_POST,'id', FILTER_VALIDATE_INT);
        $data['username'] = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
        $data['email'] = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $data['Task'] = filter_input(INPUT_POST,'Task', FILTER_SANITIZE_STRING);
        $data['status'] = ($_POST['status'] == 'completed') ? 'completed' : 'incomplete';
        $this->model->editTask($data);
    }
}
