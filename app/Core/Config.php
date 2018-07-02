<?php

namespace App\Core;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
        $dotEnv = new Dotenv();
        $dotEnv->load(APPLICATION_PATH . '/../.env');
        define('ERROR_CODE_FILE_NOT_IMAGE', 1);
        define('ERROR_CODE_FILE_NOT_UPLOADED', 2);
        define('ERROR_CODE_FILE_NOT_SELECT', 3);
        define('ERROR_CODE_RECORD_NOT_INSERT_IN_DB', 4);
        define('ERROR_CODE_PAGE_NOT_FOUND', 5);
        define('ERROR_CODE_FORM_VALIDATION', 6);
        define('ERROR_CODE_AUTH', 7);
        define('ERROR_CODE_PASSWORD_NOT_CONFIRM', 8);
        define('ERROR_CODE_NOT_ALLOWED', 9);
        define('ERROR_CODE_RECORD_NOT_UPDATED_IN_DB', 10);
        define('DONE_UPDATE_USER', 11);
        define('DONE_REMOVE_USER', 12);
        define('DONE_UPLOAD_FILE', 'file uploaded');
        define('DONE_REMOVE_FILE', 'file deleted');
        define('DONE_AUTH', 'access granted');
        define('DONE_REGISTRATION', 'user added in system');
    }
}
