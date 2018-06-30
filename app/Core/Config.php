<?php

namespace App\Core;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $dotEnv = new Dotenv();
        $dotEnv->load(APPLICATION_PATH . '/../.env');
    }
}
