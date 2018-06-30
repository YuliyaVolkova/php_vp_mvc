<?php

namespace App\Controllers;

use App\Models\File;
use Exception;

class FileController extends MainController
{
    use ImageClearController;

    public function user()
    {
        $userId = $_SESSION['authorized_id'];
        $files = File::getFilesByUser($userId);
        $data = [
            'files' => $files,
        ];
        $this->view->render('file_all', $data);
    }

    public function create()
    {
        $userId = $_SESSION['authorized_id'];
        if ($userId && strlen($_FILES['photo']['name'])) {
            $this->file = $_FILES['photo'];
            $this->uploadedImageHandler();
            $file = File::store($this->filePath, $userId);
            if (!empty($file)) {
                echo 'Файл загружен';
                echo '<div><a href="/file/user">Вернуться назад</a></div>';
            } else {
                throw new Exception('Файл не загружен');
            }
        } else {
            echo 'Ответ сервера: Не выбран файл.';
            echo '<div><a href="/file/user">Вернуться назад</a></div>';
            return null;
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        if ($id > 0) {
            $file =  File::remove($id);
            if ($file) {
                echo 'Аватар ' . $file->file_url . ' успешно удален';
                echo '<div><a href="/file/user">Вернуться назад</a></div>';
            } else {
                throw new Exception('Некорректный запрос на удаление');
            }
        }
    }
}
