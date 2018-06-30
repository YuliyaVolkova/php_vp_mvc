<?php

namespace App\Controllers;

trait ClearDataController
{
    protected function clear($field)
    {
        $field = strip_tags($field);
        $field = htmlspecialchars($field, ENT_QUOTES);
        $field = trim($field);
        return $field;
    }

    protected function clearAll()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $this->clear($val);
        }
        return $data;
    }
}
