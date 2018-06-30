<?php

namespace App\Core;

use Exception;
use App\Models\DB;
use App\Controllers\LoginController;
use App\Controllers\RegController;

class Router
{
    public $cName = 'Login';
    public $cAction = 'index';

    protected function getData()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ($routes[1] === 'login' && !empty($_POST)) {
            $this->cAction = 'authorization';
        }

        if ($routes[1] === 'reg' && !empty($_POST)) {
            $this->cAction = 'registration';
        }

        if (empty($routes[1]) || $routes[1] === 'index') {
            $file = APPLICATION_PATH . '/Controllers/' . $this->cName . 'Controller.php';
            $class = '\App\Controllers\\' . $this->cName . 'Controller';
            $_SESSION['authorized_id'] = 0;
            return $this->rqCheck($file, $class, $this->cAction);
        } else {
            $controllerFromRq = ucfirst(strtolower($routes[1]));
            $fileFromRq = APPLICATION_PATH . '/Controllers/' . $controllerFromRq . 'Controller.php';
            $classFromRq = '\App\Controllers\\' . $controllerFromRq . 'Controller';
            $actionFromRq = (!empty($routes[2])) ? $routes[2] : $this->cAction;

            if ($controllerFromRq === 'User' && explode('?', $actionFromRq)[0] === 'delete') {
                $actionFromRq = 'delete';
            }

            if ($controllerFromRq === 'File' && explode('?', $actionFromRq)[0] === 'delete') {
                $actionFromRq = 'delete';
            }

            if ($controllerFromRq === 'Reg' && empty($_POST)) {
               $_SESSION['authorized_id'] = 0;
            }

            if ($controllerFromRq === 'User' && $actionFromRq === 'all' && (!$_SESSION['authorized_id'])) {
                throw new Exception('Доступ только для авторизованных пользователей');
            }

            if ($controllerFromRq === 'File' && (!$_SESSION['authorized_id'])) {
                throw new Exception('Доступ только для авторизованных пользователей');
            }

            return $this->rqCheck($fileFromRq, $classFromRq, $actionFromRq);
        }
    }

    protected function rqCheck($file, $class, $action)
    {
        if (!file_exists($file)) {
             throw new Exception('Controller file not found');
        }
        if (class_exists($class)) {
            $controller = new $class();
        } else {
            throw new Exception('File found but Class not found');
        }
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            throw new Exception('Method not found');
        }
    }

    public function __construct()
    {
        try {
            DB::connect();
            $this->getData();
        } catch (Exception $e) {
            require APPLICATION_PATH . '/Views/404.php';
        }
    }
}
