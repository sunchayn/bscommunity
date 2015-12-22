<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Filters {

    function __construct()
    {
        //initialise lists
    }

    /** exlude external URL from a given string
     * @param $input
     * @return mixed
     */
    public static function externalFilter($input)
    {
        if (Controller::$GLOBAL['external'] != 1)
            return $input;
        preg_match_all('/(http(s)?:\/\/)?(www\.)?([a-zA-Z0-9][a-zA-Z0-9\s]+)(\.[a-zA-Z]+)(\/)?/u',$input, $matches);
        foreach($matches[0] as $url)
        {
            if (filterAPI::getInstance()->isBadURL(trim($url), Controller::$GLOBAL['filterMode']))
                $input = str_replace($url, '--##--', $input);
        }
        return $input;
    }


    /**
     * @param $input
     * @return mixed
     */
    public static function sexualContentFilter($input)
    {
        //get the bad words list
        $getBadWords = array_merge(include (ROOT.'application/languages/bad words/ar.php'), include (ROOT.'application/languages/bad words/en.php'));
        foreach($getBadWords as $word)
            $input = str_replace($word, '***', $input);

        return $input;
    }
}