<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;

class UserController extends MainController
{
    protected $users;

    protected function setAge()
    {
        $now = Carbon::now();

        foreach ($this->users as $key => $user) {
            $this->users[$key]['birthday'] = $now->diffInYears($user['birthday']);
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

        if (empty($id) || $id == $_SESSION['authorized_id']) {
            return $this->all();
        }

        File::removeAllByUser($id);
        $user =  User::remove($id);

        if (empty($user)) {
            return $this->all();
        }

        $data = [
            'user' => $user,
        ];

        $this->view->render('mesUser', $data);
    }
}
