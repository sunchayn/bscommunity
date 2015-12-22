<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

/** isset_get()
 * check if the second param exist as a key for the first param ( return value if exist or third param )
 * @param $element
 * @param $key
 * @param string $default
 * @return string
 */
function isset_get($element, $key, $default = null) {
    $default = (!isset($default)) ? language::invokeOutput('frequent/unset') : $default;
    if (is_array($element))
        return isset($element[$key]) ? $element[$key] : $default;
    else if (is_object($element))
        return isset($element->$key) ? $element->$key : $default;
    else
        return $default;
}

/** rrmdir()
 * remove a directory and it's content
 * 'recursive function
 * @param $dir
 */
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

/** renderOutput()
 * remove bad script from the string to prevent XSS1
 * @param $input
 * @param bool|false $escape
 * @return mixed
 */
function renderOutput($input, $escape = false)
{
    if (!is_string($input))
        return $input;
    //remove javascript codes
    $output = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '',$input);
    //remove the stylesheet
    $output = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '',$output);
    //escape string for other codes
    if ($escape)
        $output = preg_replace('/[<\/\'\>\\\\"]/is', '',$output);
    return $output;
}

/** getRealDate()
 * get the exact date format from the given string
 * @param $date
 * @return string
 */
function getRealDate($date)
{
    //if the given string not a date string
    if (!preg_match('/[\d\/-]{10}/', $date))
        return false;
    //get the middle part ( supposed to be month )
    preg_match('/[-\/](\d{2})[-\/]/', $date, $month);
    $m = isset_get($month,1,'01');
    //get the last part or first part( supposed to be month )
    preg_match('/[-\/](\d{2})$|^(\d{2})[-\/]/', $date, $day);
    $d = !empty($day[1]) ? $day[1] : $day[2];
    //get the year part
    preg_match('/(\d{4})/', $date, $year);
    $y = $year[1];
    //if the month not valid
    if ((int)$m > 12)
        $m = '01';
    //if the day not valid
    if((int)$d > 31)
        $d = '01';
    //return the new date
    return $y.'/'.$m.'/'.$d;
}
//remove all spaces in the sides
function fullTrim($input)
{
    return preg_replace('/^\s+|\s+$/u', '', $input);
}