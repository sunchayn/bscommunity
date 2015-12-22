<?php
/**
 * bloodstone community V1.0.0
 * onlineAPI Class !
 * an API that handle online users
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class onlineAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'online';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new onlineAPI(Controller::$db);
        }
        return self::$_instance;
    }
    /**
     * define the database variable when call this class
     * @param $db
     */
    function __construct($db){
        $this->setDataBase($db);
    }

    /**
     * @return mixed
     */
    function getOnlineUsers()
    {
        return parent::selectData('count(*) as c', null, $this->_table, null)[0]->c;
    }

    /**
     *
     */
    function updateOnline()
    {
        $sql = 'REPLACE INTO '. $this->_table .' (`ip`) VALUE (?)';
        parent::executeQuery($sql, [$_SERVER['REMOTE_ADDR']], false);
        #delete time out online
        parent::deleteData($this->_table, ['`time` < DATE_SUB(now(), INTERVAL 2 MINUTE)']);
    }
}