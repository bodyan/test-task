<?php

/**
* based on https://www.devbattles.com/en/sand/post-39-Make+simple+MVC+on+PHP
*/
class Route
{
    static function start()
    {
        $controller = 'Main';
        $action = 'index';
        $parameters = [];

        $url = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

        if (!empty($url[0])) {
            $controller = (strtolower($url[0]) !== 'index') ? ucfirst($url[0]) : 'Main';
        }

        if (!empty($url[1])) {
            if(strpos($url[1], "?") && isset($_GET) && !empty($_GET)) {
                $tmp_action = explode("?", $url[1]);
                $action = $tmp_action[0];
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                $order = filter_input(INPUT_GET, 'sortby', FILTER_SANITIZE_STRING);
                if(!empty($page)) {
                    $parameters['page'] = $page;
                }
                if(!empty($order)) {
                    $parameters['order'] = $order;
                }
                if(!empty($id)) {
                    $parameters['id'] = $id;
                }
            } else {
                $action = $url[1];
            }
        }

        $actionName = $action.'Action';

        $modelName = $controller.'Model';
        $modelFile = $modelName.'.php';
        $modelPath = "src/Model/".$modelFile;

        if(file_exists($modelPath)) {
            require 'src/Model/'.$modelFile;
        }

        $controllerName = $controller.'Controller';
        $controllerFile = $controllerName.'.php';
        $controllerPath = "src/Controller/".$controllerFile;
        if(file_exists($controllerPath)) {
            require 'src/Controller/'.$controllerFile;
        } else {
            header("Location: /");
            exit();
        }

        $controller = new $controllerName;
        $action = $actionName;

        if(method_exists($controller, $action) && count($parameters) > 0) {
                $controller->$action($parameters);
        }elseif(method_exists($controller, $action)) {
                $controller->$action();
        } else {
            Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        echo "Error 404";
        /*$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');*/
    }
}



 ?>
