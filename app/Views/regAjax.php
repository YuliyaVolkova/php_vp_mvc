<?php
switch ($result) {
    case (ERROR_CODE_FORM_VALIDATION):
        $message = 'Ответ сервера: проверьте заполнение полей. ';
        break;
    case (ERROR_CODE_PASSWORD_NOT_CONFIRM):
        $message = 'Правильно введите повторный пароль. ';
        break;
    case (DONE_REGISTRATION):
        $message = 'Вы зарегистрированы, '  . $user['name'] . ' . ';
        break;
    default:
        $message = 'Регистрация не удалась, повторите попытку позже. ';
}
echo $message;
