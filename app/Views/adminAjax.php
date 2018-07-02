<?php
switch ($result) {
    case (ERROR_CODE_FORM_VALIDATION):
        $message = 'Ответ сервера: проверьте заполнение полей. ';
        break;
    case (ERROR_CODE_RECORD_NOT_INSERT_IN_DB):
        $message = 'Пользователь не может быть добавлен в систему. ';
        break;
    case (ERROR_CODE_RECORD_NOT_UPDATED_IN_DB):
        $message = 'Данные пользователя не обновлены. ';
        break;
    case (DONE_REGISTRATION):
        $message = 'Новый пользователь  по имени '  . $user['name'] . ' добавлен. ';
        break;
    case (DONE_UPDATE_USER):
        $message = 'Данные пользователя с email ' . $user['email'] . ' успешно обновлены. ';
        break;
    default:
        $message = '';
}
echo $message;
