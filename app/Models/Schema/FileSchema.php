<?php

namespace App\Models\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class FileSchema
{
    public static function delete()
    {
        Capsule::schema()->dropIfExists('files');
    }
    public static function create()
    {
        Capsule::schema()->create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_url');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }
}
