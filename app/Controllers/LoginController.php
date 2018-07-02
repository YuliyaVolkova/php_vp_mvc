<?php

namespace App\Controllers;

use Gump;
use App\Models\User;

class LoginController extends MainController
{
    use ClearDataController;

    protected $data;
    protected $user;

    protected function gumpValidate()
    {
        return $result = GUMP::is_valid($this->data, [
            'login' => 'required|alpha_numeric',
            'password' => 'required|max_len,100|min_len,6'
        ]);
    }

    protected function checkAuth()
    {
        if ($this->gumpValidate() !== true) {
            return ERROR_CODE_FORM_VALIDATION;
        }

        $user = User::getUserByLogin($this->data['login']);

        if (empty($user) || !password_verify($this->data['password'], $user[0]['password'])) {
            return ERROR_CODE_AUTH;
        }

        $_SESSION['authorized_id'] = $user[0]['id'];
        $this->user = $user[0];
        return DONE_AUTH;
    }

    public function authorization()
    {
        $this->data = $this->clearAll();

        $data = [
            'result' => $this->checkAuth(),
            'user' => $this->user
        ];

        $this->view->render('loginAjax', $data);
    }

    public function index()
    {
        $this->view->render('index', []);
    }
}
