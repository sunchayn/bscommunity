<?php

class General {

    public static function getFormedTime($time)
    {
        return date('F d, Y', strtotime($time));
    }
}