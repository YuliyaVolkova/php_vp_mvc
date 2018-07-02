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
            $_SESSION['authorized_id'] = null;
            return $this->rqCheck($file, $class, $this->cAction);
        }
         $controllerFromRq = ucfirst(strtolower($routes[1]));
         $fileFromRq = APPLICATION_PATH . '/Controllers/' . $controllerFromRq . 'Controller.php';
         $classFromRq = '\App\Controllers\\' . $controllerFromRq . 'Controller';
         $actionFromRq = (!empty($routes[2])) ? $routes[2] : $this->cAction;

        if (($controllerFromRq === 'User' || $controllerFromRq === 'File') && explode('?', $actionFromRq)[0] === 'delete') {
            $actionFromRq = 'delete';
        }

        if ($controllerFromRq === 'Admin' && explode('?', $actionFromRq)[0] === 'store' && !empty($_POST)) {
            $actionFromRq = 'store';
        }

        if ($controllerFromRq === 'Admin' && explode('?', $actionFromRq)[0] === 'edit') {
            $actionFromRq = 'edit';
        }

        if ($controllerFromRq === 'Admin' && explode('?', $actionFromRq)[0] === 'update' && !empty($_POST)) {
            $actionFromRq = 'update';
        }

        if ($controllerFromRq === 'Admin' && explode('?', $actionFromRq)[0] === 'delete') {
            $actionFromRq = 'delete';
        }

        if ($controllerFromRq === 'Reg' && empty($_POST)) {
            $_SESSION['authorized_id'] = null;
        }

        if ($controllerFromRq === 'User' && (!$_SESSION['authorized_id'])) {
            throw new Exception('Доступ только для авторизованных пользователей');
        }

        if ($controllerFromRq === 'File' && (!$_SESSION['authorized_id'])) {
            throw new Exception('Доступ только для авторизованных пользователей');
        }

        return $this->rqCheck($fileFromRq, $classFromRq, $actionFromRq);
    }

    protected function rqCheck($file, $class, $action)
    {
        if (!file_exists($file)) {
             throw new Exception('Controller file not found');
        }
        if (!class_exists($class)) {
            throw new Exception('File found but Class not found');
        }
        $controller = new $class();
        if (!method_exists($controller, $action)) {
            throw new Exception('Method not found');
        }
        $controller->$action();
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
