<?php

namespace  App\Models\Schema;

use App\Models\File;
use App\Models\User;
use Faker\Factory;

class Populate
{
    public static function fakerFiles()
    {
        for ($i = 0; $i < 15; $i++) {
            $faker = Factory::create();
            $file = new File();
            $file->file_url = $faker->imageUrl($width = 100, $height = 100);
            $file->user_id = $faker->numberBetween($min = 1, $max = 10);
            $file->save();
            $user = new User;
            $user->name = $faker->name;
            $user->password = $faker->password;
            $user->email = $faker->email;
            $user->login = $faker->userName;
            $user->birthday = $faker->date($format = 'Y-m-d', $max = '2005-01-01');
            $user->description = $faker->text;
            $user->created_at = $faker->dateTime;
            $user->updated_at = $faker->dateTime;
            $user->save();

        }
    }
}
