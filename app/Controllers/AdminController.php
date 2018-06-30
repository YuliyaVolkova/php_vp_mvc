<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\User;
use Exception;
use Gump;

class AdminController extends MainController
{
    use ClearDataController, ImageClearController;

    protected $data;

    protected function validation()
    {
        return $result = GUMP::is_valid($this->data, [
            'name' => 'required|valid_name',
            'birthday' => 'required|date',
            'email' => 'required|valid_email',
            'login' => 'required|alpha_numeric',
            'password' => 'required|max_len,100|min_len,6'
        ]);
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
        if ($this->validation() === true) {
            $this->data['password'] = crypt($this->data['password'], getenv('SALT'));
            $user = User::store($this->data['name'], $this->data['login'], $this->data['email'], $this->data['password'], $this->data['birthday'], $this->data['description']);
            if ($user === null) {
                return null;
            }
            if ($user['id']) {
                if (strlen($_FILES['photo']['name'])) {
                    $this->file = $_FILES['photo'];
                    $this->uploadedImageHandler();
                    File::store($this->filePath, $user['id']);
                }
                echo 'Новый пользователь  по имени '  . $user['name'] . ' добавлен. ';
            } else {
                echo 'Регистрация не удалась, повторите попытку позже. ';
            }
        } else {
            echo 'Ответ сервера: проверьте заполнение полей. ';
            return null;
        }
    }

    public function edit()
    {
        $id=$_GET['id'];
        if (empty($id) || !intval($id)) {
            echo 'Не указан Id пользователя';
            echo '<div><a href="/admin/all">Вернуться назад</a></div>';
            return null;
        }
        $user = User::edit($id);
        if (empty($user)) {
            echo 'Пользователя с таким Id нет';
            echo '<div><a href="/admin/all">Вернуться назад</a></div>';
            return null;
        }
        $data = ['user' => $user];
        $this->view->render('edit', $data);
    }

    public function update()
    {
        $this->data = $this->clearAll();

        if ($this->validation() === true) {
            $this->data['password'] = crypt($this->data['password'], getenv('SALT'));
            $id=$_GET['id'];
            if (empty($id) || !intval($id)) {
                echo 'Не указан Id пользователя';
                echo '<div><a href="/admin/all">Вернуться назад</a></div>';
                return null;
            }
            $user = User::updateUser($id, $this->data['name'], $this->data['login'], $this->data['email'], $this->data['password'], $this->data['birthday'], $this->data['description']);
            if (empty($user)) {
                echo '<div><a href="/admin/all">Вернуться назад</a></div>';
                return null;
            }
            if (strlen($_FILES['photo']['name'])) {
               $this->file = $_FILES['photo'];
               $this->uploadedImageHandler();
               File::store($this->filePath, $user->id);
            }
            echo 'Данные пользователя с email ' . $user->email . ' успешно обновлены. ';
        } else {
            echo 'Ответ сервера: проверьте заполнение полей.';
            return null;
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        if ($id > 0) {
            File::removeAllByUser($id);
            $user =  User::remove($id);
            if ($user) {
                echo 'Пользователь ' . $user->name . ' успешно удален. ';
                echo '<div><a href="/admin/all">Вернуться назад</a></div>';
            } else {
                throw new Exception('Некорректный запрос на удаление. ');
            }
        }
    }
}
