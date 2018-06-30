<?php

namespace App\Models\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserSchema
{
    public static function delete()
    {
        Capsule::schema()->dropIfExists('users');
    }
    public static function create()
    {
        Capsule::schema()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('login');
            $table->string('password');
            $table->date('birthday');
            $table->text('description');
            $table->timestamps();
        });
    }
}
