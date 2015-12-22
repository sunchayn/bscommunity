<?php
/**
 * bloodstone community V1.0.0
 * accessAPI Class !
 * an API for management access
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class rateReplyAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'reply_rate';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new rateReplyAPI(Controller::$db);
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
     * @param $reply
     * @param $user
     * @return mixed
     */
    public function getUserRate($reply, $user)
    {
       return parent::selectData('id, value', [ [ 'reply_id', '=', $reply ], [ 'user_id', '=', $user ] ], $this->_table, null, 'LIMIT 1');
    }

    /**
     * @param $data
     */
    public function insertRate($data)
    {
        parent::insertData($this->_table, ['reply_id', 'user_id', 'value'], $data);
    }

    /**
     * @param $id
     * @param $value
     */
    public function updateRate($id, $value)
    {
        parent::updateData('reply_rate', ['field' => 'id', 'value' => $id], ['value' => $value]);
    }
}