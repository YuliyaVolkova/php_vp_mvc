<?php

namespace App\Controllers;

use Gump;
use App\Models\User;

class LoginController extends MainController
{
    use ClearDataController;

    protected $data;

    public function index()
    {
        $this->view->render('index', []);
    }

    protected function gumpValidate()
    {
        return $result = GUMP::is_valid($this->data, [
            'login' => 'required|alpha_numeric',
            'password' => 'required|max_len,100|min_len,6'
        ]);
    }

    public function authorization()
    {
        $this->data = $this->clearAll();

        if ($this->gumpValidate() === true) {
            $this->data['password'] = crypt($this->data['password'], getenv('SALT'));
            $user = User::getUser($this->data['login'], $this->data['password']);
            if (!empty($user)) {
                echo 'Вы авторизированы, '  . $user[0]['name'] . '.';
                $_SESSION['authorized_id'] = $user[0]['id'];
            } else {
                echo 'Неверная пара логин - пароль.';
                $_SESSION['authorized_id'] = 0;
            }
        } else {
            echo 'Ответ сервера: проверьте заполнение полей.';
            $_SESSION['authorized_id'] = 0;
            return null;
        }
    }
}
