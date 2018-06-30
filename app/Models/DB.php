<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class DB
{
    static public $capsule = null;

    public static function connect()
    {
        if (!self::$capsule) {
            self::$capsule = new Capsule;

            self::$capsule->addConnection([
                'driver' => 'mysql',
                'host'  => getenv('DB_HOST_NAME'),
                'database' => getenv('DB'),
                'username' => getenv('DB_USER_NAME'),
                'password' => getenv('DB_PASSWORD'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => ''
            ]);
            self::$capsule->setAsGlobal();
            self::$capsule->bootEloquent();
        }
    }
}
