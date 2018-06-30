<?php

namespace App\Controllers;

use Gump;

trait ValidationDataController
{
    protected $data;

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
}
