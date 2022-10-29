<?php

class Fun
{

    public static function redirect($url, $type, $msg)
    {
        return  header("Location:$url?$type=$msg");
    }


    public static function checkForEmptyInput($param = [])
    {
        for ($i = 0; $i < sizeof($param); $i++) {
            if (!isset($param[$i]) || empty($param[$i])) {
                return true;
            }
        }
        return false;
    }
}
