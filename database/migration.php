<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Config;
use App\Models\Schema\MainMigration;
use App\Models\Schema\Populate;

define('APPLICATION_PATH', realpath(getcwd() . '/../app/'));
new Config();
MainMigration::createTables();
Populate::fakerFiles();
