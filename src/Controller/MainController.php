<?php

class MainController extends Controller
{

    public $tasksPerPage = 3;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->view = new View('src/Views/MainTemplate.phtml');
    }

    public function countPage()
    {
        $countTasks = count($this->model->getTasks());
        $numOfPages = $countTasks / $this->tasksPerPage;
        $numOfPages = (!is_float($numOfPages)) ? $numOfPages : intval($numOfPages+1);
        return $numOfPages;
    }

    public function showAction($input)
    {
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

        $this->view->render('src/Views/IndexTemplate.phtml', [
            'tasks' => $tasks,
            'pagination' => $pagination,
            'order' => $order
            ]);
    }

    public function indexAction()
    {
        $default_data = ['page' => 1, 'order' => ''];
        return $this->showAction($default_data);
    }

    public function sortbyuserAction(){
        $tasks = $this->model->sortByUsersAsc();
        $this->view->render('/src/Views/IndexTemplate.phtml', ['tasks' => $tasks]);
    }

    public function sortbyuserdescAction(){
        $tasks = $this->model->sortByUsersDesc();
        $this->view->render('/src/Views/IndexTemplate.phtml', ['tasks' => $tasks]);
    }

    public function sortbyemailAction(){
        $tasks = $this->model->sortByEmailAsc();
        $this->view->render('/src/Views/IndexTemplate.phtml', ['tasks' => $tasks]);
    }

    public function sortbyemaildescAction(){
        $tasks = $this->model->sortByEmailDesc();
        $this->view->render('/src/Views/IndexTemplate.phtml', ['tasks' => $tasks]);
    }

    public function sortbystatusAction(){
        $tasks = $this->model->sortByStatusAsc();
        $this->view->render('/src/Views/IndexTemplate.phtml', ['tasks' => $tasks]);
    }

    public function sortbystatusdescAction(){
        $tasks = $this->model->sortByStatusDesc();
        $this->view->render('/src/Views/IndexTemplate.phtml', ['tasks' => $tasks]);
    }


}

