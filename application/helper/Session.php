<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Session {

    /**
     * tell if the Session has initialised or not
     * @var boolean
     */
    private static $started = false;

    /**
     * initialise a new session when no session in the stack
     */
    public static function initSession()
    {
        if (!self::$started)
        {
            session_start();
            self::$started = true;
        }
        //prevent session fixation
        if (!self::get('regen'))
            self::set('regen', 0);
        if (++$_SESSION[SESSION_PREFIX.'regen'] >= 10)
        {
            self::set('regen', 0);
            @session_regenerate_id(true);
        }
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        if (is_string($value))
            $value = renderOutput($value);
        return $_SESSION[SESSION_PREFIX.$key] = $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function setArray($key, $value)
    {
        return $_SESSION[SESSION_PREFIX.$key][] = $value;
    }

    /**
     * get the session with the given key
     * @param $key
     * @return bool
     */
    public static function get($key)
    {
        if (isset($_SESSION[SESSION_PREFIX.$key])) {
            return $_SESSION[SESSION_PREFIX.$key];
        }
        return false;
    }

    /**
     * @param $key
     * @param $subKey
     * @return bool
     */
    public static function getArray($key, $subKey)
    {
        if (isset($_SESSION[SESSION_PREFIX.$key][$subKey])) {
            return $_SESSION[SESSION_PREFIX.$key][$subKey];
        }
        return false;
    }

    /**
     * destroy a session based on the given key
     * @param string $key
     * @return bool
     */
    public static function destroy($key = '')
    {
        if (self::exists($key)) unset($_SESSION[SESSION_PREFIX.$key]) ;  else return false;
        return true;
    }

    /**
     * @param string $key
     * @param string $subKey
     * @return bool
     */
    public static function destroyArray($key = '', $subKey = '')
    {
        if (self::existsArray($key, $subKey)) unset($_SESSION[SESSION_PREFIX.$key][$subKey]) ;  else return false;
        return true;
    }

    /**
     * destroy all sessions
     */
    public static function clear()
    {
        session_unset();
        session_destroy();
    }

    /**
     * tell if the given key match an exist session
     * @param $key
     * @return bool
     */
    public static function exists($key)
    {
        return (self::get($key) === false) ? false : true;
    }

    /**
     * @param $key
     * @param $subKey
     * @return bool
     */
    public static function existsArray($key, $subKey)
    {
        return (self::getArray($key, $subKey) === false) ? false : true;
    }

    /**
     * tell if the key and the value match an exist session
     * @param $key
     * @param $value
     * @return bool
     */
    public static function legal($key, $value)
    {
        return (isset($_SESSION[SESSION_PREFIX.$key]) &&  $_SESSION[SESSION_PREFIX.$key] == $value);
    }

    /**
     * Get the session array
     * @return mixed
     */
    public static function holder()
    {
        return $_SESSION;
    }
}