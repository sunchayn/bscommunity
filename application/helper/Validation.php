<?php
/**
 * bloodstone community V1.0.0
 * Validation Class !
 * an class for validation process
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class Validation {

    public static function isRestrictEntry($string)
    {
        //soon
        return false;
    }

    /**
     * @param array $array
     * @return bool
     */
    public static function issetEmptyValue($array = array())
    {
        $test = false;
        foreach ($array as $value)
        {
            if (!isset($value[0]))
            {
               $test = true;
                break;
            }
        }
        return $test;
    }

    /**
     * @param $require
     * @param $data
     * @return bool
     */
    public static function isRequireEmpty($require, $data)
    {
        foreach ($require as $req)
            if (!isset($data[$req][0]))
                return true;
        return false;
    }
}