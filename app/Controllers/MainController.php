<?php

namespace App\Controllers;

use App\Views\View;

abstract class MainController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
