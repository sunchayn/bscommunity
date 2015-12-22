<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Cookie {

    /**
     * @param $key
     * @return bool
     */
    public static function exists($key)
     {
         return (isset($_COOKIE[SESSION_PREFIX.$key])) ? true : false;
     }

    /**
     * @param $key
     * @return bool
     */
    public static function get($key)
    {
        return (isset($_COOKIE[SESSION_PREFIX.$key])) ? $_COOKIE[SESSION_PREFIX.$key] : false;
    }

    /**
     * @param $key
     * @param $value
     * @param $expire
     * @return bool
     */
    public static function set($key, $value, $expire)
    {
        return (setcookie(SESSION_PREFIX.$key, $value, $expire, '/')) ? true : false;
    }

    /**
     * @param $key
     */
    public static function delete($key)
    {
        self::set($key, '', time() - 1);
    }
}