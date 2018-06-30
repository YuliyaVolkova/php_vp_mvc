<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class User extends Model
{
    protected $fillable = ['name', 'login', 'email', 'password', 'birthday', 'description'];
    public $table = "users";

    public static function getUser($login, $password)
    {
        return $user = User::where('login', '=', $login)->where('password', '=', $password)->get()->toArray();
    }

    public static function getUserByLogin($login)
    {
        return $user = User::where('login', '=', $login)->get()->toArray();
    }

    public static function getUserByEmail($email)
    {
        return $user = User::where('email', '=', $email)->get()->toArray();
    }

    public function files()
    {
        return $this->hasMany('App\Models\File', 'user_id', 'id');
    }

    public static function store($name, $login, $email, $password, $birthday, $description)
    {
        $user = self::getUserByLogin($login);
        if (!empty($user)) {
            echo 'Пользователь с заданным логином существует';
            return null;
        }
        $user = self::getUserByEmail($email);
        if (!empty($user)) {
            echo 'На данный email зарегистрирован пользователь';
            return null;
        }
        $user = new User();
        $user->name = $name;
        $user->login = $login;
        $user->email = $email;
        $user->password = $password;
        $user->birthday = $birthday;
        $user->description = $description;
        $user->save();
        return $user->toArray();
    }

    public static function getAllOrderByAgeDesc()
    {
        return $users = User::with('files')
            ->orderBy('birthday', 'desc')
            ->get()->toArray();
    }

    public static function getAllOrderByAgeAsc()
    {
        return $users = User::with('files')
            ->orderBy('birthday', 'asc')
            ->get()->toArray();
    }

    public static function remove($id)
    {
        if (!empty($id)) {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return $user;
            }
            return null;
        }
    }

    public function edit($id, $name, $login, $email, $password, $bDate, $description)
    {
        if (!empty($id)) {
            $user = User::find($id);
            $this->name = $name;
            $this->login = $login;
            $this->email = $email;
            $this->password = $password;
            $this->b_date = $bDate;
            $this->description = $description;
            $user->save();
        }
    }
}
