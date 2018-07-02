<?php

namespace App\Controllers;

use App\Models\File;

class FileController extends MainController
{
    use ImageClearController;

    protected $userId;

    protected function store()
    {
        if (empty($_FILES['photo']['name'])) {
            return ERROR_CODE_FILE_NOT_SELECT;
        }

        $this->file = $_FILES['photo'];

        if (!$this->uploadedImageHandler()) {
            return ERROR_CODE_FILE_NOT_UPLOADED;
        }

        $file = File::store($this->filePath, $this->userId);

        if (empty($file)) {
            return ERROR_CODE_RECORD_NOT_INSERT_IN_DB;
        }

        return DONE_UPLOAD_FILE;
    }

    public function create()
    {
        $this->userId = $_SESSION['authorized_id'];

        $data = [
            'result' => $this->store()
            ];

        $this->view->render('mesFile', $data);
    }

    public function delete()
    {
        $id = $_GET['id'];

        if (empty($id)) {
            return $this->user();
        }

        $file =  File::remove($id);

        if (empty($file)) {
            return $this->user();
        }

        $data = [
            'result' => DONE_REMOVE_FILE,
            'file' => $file
        ];

        $this->view->render('mesFile', $data);
    }

    public function user()
    {
        $this->userId = $_SESSION['authorized_id'];
        $files = File::getFilesByUser($this->userId);

        $data = [
            'files' => $files,
        ];

        $this->view->render('file_all', $data);
    }
}
