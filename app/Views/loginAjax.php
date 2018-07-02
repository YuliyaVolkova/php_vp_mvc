<?php
switch ($result) {
    case (ERROR_CODE_FORM_VALIDATION):
        $message = 'Ответ сервера: проверьте заполнение полей. ';
        break;
    case (ERROR_CODE_AUTH):
        $message = 'Неверная пара логин - пароль. ';
        break;
    case (DONE_AUTH):
        $message = 'Вы авторизированы, '  . $user['name'] . '. ';
        break;
    default:
        $message = '';
}
echo $message;
