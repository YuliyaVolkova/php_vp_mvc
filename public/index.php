<?php

use App\Core\Router;
use App\Core\Config;

session_start();

define('PUBLIC_PATH', getcwd());
define('APPLICATION_PATH', realpath(PUBLIC_PATH . '/../app/'));

require_once __DIR__ . '/../vendor/autoload.php';
new App\Core\Config();

new Router();
