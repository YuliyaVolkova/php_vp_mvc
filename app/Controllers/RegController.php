<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\File;
use Gump;

class RegController extends MainController
{
    use ClearDataController, ImageClearController;

    protected $data;
    protected $user;

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

    protected function checkRegistration()
    {
        if ($this->validation() !== true) {
            return ERROR_CODE_FORM_VALIDATION;
        }

        if ($this->data['password'] !== $this->data['password-again']) {
            return ERROR_CODE_PASSWORD_NOT_CONFIRM;
        }
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_BCRYPT);
        $user = User::store($this->data['name'], $this->data['login'], $this->data['email'], $this->data['password'], $this->data['birthday'], $this->data['description']);

        if (empty($user)) {
            return ERROR_CODE_RECORD_NOT_INSERT_IN_DB;
        }

        if (strlen($_FILES['photo']['name'])) {
            $this->file = $_FILES['photo'];
            $this->uploadedImageHandler();
            File::store($this->filePath, $user['id']);
        }

        $_SESSION['authorized_id'] = $user['id'];
        $this->user = $user;
        return DONE_REGISTRATION;
    }

    public function index()
    {
        $this->view->render('reg', []);
    }

    public function registration()
    {
        $this->data = $this->clearAll();

        $data = [
            'result' => $this->checkRegistration(),
            'user' => $this->user
        ];

        $this->view->render('regAjax', $data);
    }
}
