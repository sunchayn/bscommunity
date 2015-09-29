<?php

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