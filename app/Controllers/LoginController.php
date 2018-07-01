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
            $user = User::getUserByLogin($this->data['login']);
            if (!empty($user) && password_verify($this->data['password'], $user[0]['password'])) {
                echo 'Вы авторизированы, '  . $user[0]['name'] . '.';
                $_SESSION['authorized_id'] = $user[0]['id'];
            } else {
                echo 'Неверная пара логин - пароль.';
            }
        } else {
            echo 'Ответ сервера: проверьте заполнение полей.';
        }
    }
}
