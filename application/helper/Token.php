<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Token
{
    private static $name = TOKEN_NAME;

    /**
     * @return mixed
     */
    public static function generate()
    {
        $get = Session::get(TOKEN_NAME);
        return ($get === false) ? Session::set(self::$name, md5(uniqid())) : $get;
    }
    /**
     * @param $token
     * @param bool|true $delete
     * @return bool
     */
    public static function check($token, $delete = true)
    {
        //if the token name as a key and the value match existent session destroy it and return true
        if (Session::legal(self::$name, $token))
        {
            if ($delete) Session::destroy(self::$name);
            return true;
        }
        return false;
    }
    public static function exist($token)
    {
        //if the token name as a key and the value match existent session destroy it and return true
        if (Session::legal(self::$name, $token))
        {
            return true;
        }
        return false;
    }
    public static function destroyToken()
    {
        //if the token name as a key and the value match existent session destroy it and return true
        return Session::destroy(self::$name);
    }
}