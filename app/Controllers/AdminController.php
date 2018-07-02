<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\User;
use Gump;

class AdminController extends MainController
{
    use ClearDataController, ImageClearController;

    protected $data;
    protected $user;

    protected function validation()
    {
        return GUMP::is_valid($this->data, [
            'name' => 'required|valid_name',
            'birthday' => 'required|date',
            'email' => 'required|valid_email',
            'login' => 'required|alpha_numeric',
            'password' => 'required|max_len,100|min_len,6'
        ]);
    }

    protected function addUser()
    {
        if ($this->validation() !== true) {
            return ERROR_CODE_FORM_VALIDATION;
        }
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_BCRYPT);
        $user = User::store($this->data['name'], $this->data['login'], $this->data['email'], $this->data['password'], $this->data['birthday'], $this->data['description']);

        if (empty($user)) {
            return ERROR_CODE_RECORD_NOT_INSERT_IN_DB;
        }

        if (!empty($_FILES['photo']['name'])) {
            $this->file = $_FILES['photo'];
            $this->uploadedImageHandler();
            File::store($this->filePath, $user['id']);
        }
        $this->user = $user;
        return DONE_REGISTRATION;
    }

    protected function editUser()
    {
        if ($this->validation() !== true) {
            return ERROR_CODE_FORM_VALIDATION;
        }

        $this->data['password'] = password_hash($this->data['password'], PASSWORD_BCRYPT);

        $id=$_GET['id'];
        if (empty($id)) {
            return ERROR_CODE_RECORD_NOT_UPDATED_IN_DB;
        }

        $user = User::updateUser($id, $this->data['name'], $this->data['login'], $this->data['email'], $this->data['password'], $this->data['birthday'], $this->data['description']);

        if (empty($user)) {
            return ERROR_CODE_RECORD_NOT_UPDATED_IN_DB;
        }

        if (!empty($_FILES['photo']['name'])) {
            $this->file = $_FILES['photo'];
            $this->uploadedImageHandler();
            File::store($this->filePath, $user['id']);
        }

        $this->user = $user;
        return DONE_UPDATE_USER;
    }

    public function all()
    {
        $users = User::getAll();
        $data = ['users' => $users];
        $this->view->render('admin', $data);
    }

    public function create()
    {
        $this->view->render('create', []);
    }

    public function store()
    {
        $this->data = $this->clearAll();

        $data = [
            'result' => $this->addUser(),
            'user' => $this->user
        ];

        $this->view->render('adminAjax', $data);
    }

    public function edit()
    {
        $id=$_GET['id'];

        if (empty($id)) {
            return $this->all();
        }

        $user = User::edit($id);

        if (empty($user)) {
            return $this->all();
        }

        $data = ['user' => $user];
        $this->view->render('edit', $data);
    }

    public function update()
    {
        $this->data = $this->clearAll();

        $data = [
            'result' => $this->editUser(),
            'user' => $this->user
        ];

        $this->view->render('adminAjax', $data);
    }

    public function delete()
    {
        $id = $_GET['id'];
        if (empty($id)) {
            return $this->all();
        }

        File::removeAllByUser($id);
        $user =  User::remove($id);

        if (empty($user)) {
            return $this->all();
        }

        $data = [
            'result' => DONE_REMOVE_USER,
            'user' => $user
        ];

        $this->view->render('mesAdmin', $data);
    }
}
