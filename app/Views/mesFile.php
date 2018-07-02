<?php
switch ($result) {
    case (ERROR_CODE_FILE_NOT_SELECT):
        $message = 'Файл не выбран';
        break;
    case (DONE_UPLOAD_FILE):
        $message = 'Файл успешно загружен';
        break;
    case (DONE_REMOVE_FILE):
        $message = 'Аватар ' . $file['file_url']. ' успешно удален';
        break;
    default:
        $message = 'Файл не загружен';
}
?>
<div><?= $message; ?></div>
<div><a href="/file/user">Вернуться назад</a></div>
