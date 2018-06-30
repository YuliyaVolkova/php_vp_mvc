<?php

namespace App\Models\Schema;

use App\Models\DB;
use App\Models\Schema\FileSchema;
use App\Models\Schema\UserSchema;

class MainMigration
{
    public static function createTables()
    {
        DB::connect();
        FileSchema::delete();
        UserSchema::delete();
        UserSchema::create();
        FileSchema::create();
    }
}
