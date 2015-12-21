<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class General {

    /**
     * @param $time
     * @return bool|string
     */
    public static function getFormedTime($time)
    {
        return date('F d, Y', strtotime($time));
    }
}