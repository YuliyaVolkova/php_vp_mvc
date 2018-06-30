<?php

namespace App\Controllers;

use Gump;
use App\Models\User;
use App\Models\File;

class RegController extends MainController
{
    use ClearDataController, ImageClearController;

    protected $data;

    public function index()
    {
        $this->view->render('reg', []);
    }

    protected function validation()
    {
        return $result = GUMP::is_valid($this->data, [
            'name' => 'required|valid_name',
            'birthday' => 'required|date',
            'email' => 'required|valid_email',
            'login' => 'required|alpha_numeric',
            'password' => 'required|max_len,100|min_len,6',
            'password-again' => 'required|max_len,100|min_len,6'
        ]);
    }

    public function registration()
    {
        $this->data = $this->clearAll();

        if ($this->validation() === true) {
            if ($this->data['password'] !== $this->data['password-again']) {
                echo 'Правильно введите повторный пароль';
                $_SESSION['authorized_id'] = 0;
                return null;
            }
            $this->data['password'] = crypt($this->data['password'], getenv('SALT'));
            $user = User::store($this->data['name'], $this->data['login'], $this->data['email'], $this->data['password'], $this->data['birthday'], $this->data['description']);
            if ($user === null) {
                $_SESSION['authorized_id'] = 0;
                return null;
            }
            if ($user['id']) {
                if (strlen($_FILES['photo']['name'])) {
                    $this->file = $_FILES['photo'];
                    $this->uploadedImageHandler();
                    File::store($this->filePath, $user['id']);
                }
                echo 'Вы зарегистрированы, '  . $user['name'] . '.';
                $_SESSION['authorized_id'] = $user['id'];
            } else {
                echo 'Регистрация не удалась, повторите попытку позже';
                $_SESSION['authorized_id'] = 0;
            }
        } else {
            echo 'Ответ сервера: проверьте заполнение полей.';
            $_SESSION['authorized_id'] = 0;
            return null;
        }
    }
}
