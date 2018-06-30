<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class UserController extends MainController
{
    protected $users;

    protected function setAge()
    {
        $now = Carbon::now();
        $i = 0;
        foreach ($this->users as $user) {
            $age = $now->diffInYears($user['birthday']);
            $text = ($age < 18) ? ' - Несовершеннолетний' : ' - Совершеннолетний';
            $this->users[$i++]['birthday'] = $age . $text;
        }
    }

    public function allReverse()
    {
        $this->users = User::getAllOrderByAgeAsc();
        $this->setAge();
        $this->view->render('user_all', $this->users);
    }

    public function all()
    {
        $this->users = User::getAllOrderByAgeDesc();
        $this->setAge();
        $this->view->render('user_all', $this->users);
    }

    public function delete()
    {
        $id = $_GET['id'];
        if ($id > 0) {
            File::removeAllByUser($id);
            $user =  User::remove($id);
            if ($user) {
                if ($id == $_SESSION['authorized_id']) {
                    $_SESSION['authorized_id'] = 0;
                }
                echo 'Пользователь ' . $user->name . ' успешно удален. ';
                echo '<div><a href="/user/all">Вернуться назад</a></div>';
            } else {
                throw new Exception('Некорректный запрос на удаление. ');
            }
        }
    }
}
