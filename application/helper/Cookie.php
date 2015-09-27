<?php

class Cookie {

     public static function exists($key)
     {
         return (isset($_COOKIE[SESSION_PREFIX.$key])) ? true : false;
     }

    public static function get($key)
    {
        return (isset($_COOKIE[SESSION_PREFIX.$key])) ? $_COOKIE[SESSION_PREFIX.$key] : false;
    }

    public static function set($key, $value, $expire)
    {
        return (setcookie(SESSION_PREFIX.$key, $value, $expire, '/')) ? true : false;
    }

    public static function delete($key)
    {
        self::set($key, '', time() - 1);
    }
}