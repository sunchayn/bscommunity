<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Hash {


    /**
     * @param $string
     * @param $salt
     * @return string
     */
    public static function generate($string, $salt)
    {
        return hash('sha256', $string.$salt);
    }

    /**
     * @param $length
     * @return string
     */
    public static function salt($length)
    {
        return base64_encode(mcrypt_create_iv(ceil(0.75*$length), MCRYPT_DEV_URANDOM));
    }

    /**
     * @return string
     */
    public static function unique()
    {
        return self::generate(uniqid(), self::salt(32));
    }
}