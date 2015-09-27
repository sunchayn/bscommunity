<?php

class Hash {


    public static function generate($string, $salt)
    {
        return hash('sha256', $string.$salt);
    }

    public static function salt($length)
    {
        return base64_encode(mcrypt_create_iv(ceil(0.75*$length), MCRYPT_DEV_URANDOM));
    }

    public static function unique()
    {
        return self::generate(uniqid(), self::salt(32));
    }
}