<?php

namespace App;


class RandomString
{
    public static function generate($length = 10){

        $randomString = uniqid (rand (),true);
        $md5c = md5($randomString);
        $md5c = substr($md5c, 0, $length);
        return $md5c;
    }
}
?>
