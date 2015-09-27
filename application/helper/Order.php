<?php
class Order {
    //the session name
    static $forum = "BSCOSNF";
    static $thread = "BSCOSNT";
    //the orders type and data array
    static $entry  = ['recent' => 'id DESC', 'popular' => 'replies DESC, id DESC', 'rate' => 'rate DESC, id DESC', 'active' => 'last_reply DESC, id DESC',  'nor' => 'nor DESC, id DESC'];

    /**
     * @param bool|true $threadForum
     * @param null another
     * @return bool|string
     */
    public static function setOrder($threadForum = true, $another = null)
    {
        $order = renderOutput(isset_get($_GET, 'order'), true);
        if ( !in_array($order, array_keys(self::$entry)) )
            return false;
        else
        {
            if (isset($another))
                $sessName = $another;
            else
                $sessName = ($threadForum)? self::$thread :  self::$forum;
            Session::set($sessName, $order);
            return 'ORDER BY ' . self::$entry[$order];
        }
    }

    /**
     * @param bool|true $formed
     * @param bool|true $threadForum
     * @param null $another
     * @return bool|string
     */
    public static function getOrder($formed = true, $threadForum = true, $another = null)
    {
        if (isset($another))
            $sessName = $another;
        else
            $sessName = ($threadForum)? self::$thread :  self::$forum;
        if ($formed)
            return (Session::get($sessName) === false) ? 'ORDER BY id DESC' : 'ORDER BY ' . self::$entry[Session::get($sessName)];
        else
            return (Session::get($sessName) === false) ? 'recent' : Session::get($sessName);
    }
}