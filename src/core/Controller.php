<?php

class Controller {

    public $model;
    public $view;
    public $pagination;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action_index()
    {
        return $this->view->render();
    }

    public function pagination()
    {
        return $this->pagination;

    }
}

