<?php
/**
 * bloodstone community V1.0.0
 * attemptAPI Class !
 * an API for attempts
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class attemptAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'attempts';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new attemptAPI(Controller::$db);
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

    public function createAttempt($id)
    {
       return parent::insertData($this->_table, ['user_id'], [$id]);
    }


    public function getAttempts($id)
    {
        $whereInject = "DATE_ADD(attempts.time, INTERVAL 5 MINUTE) > now()";
        return parent::selectData('count(*) as cnt', [ ['user_id', '=', $id], $whereInject], $this->_table);
    }

    public function checkAttempts($id)
    {
        return ($this->countAttempts($id) > 5) ? false : true;
    }

    public function countAttempts($id)
    {
        $getAttempt = $this->getAttempts($id);
        if (empty($getAttempt)) return 0; else return $getAttempt[0]->cnt;
    }

    public function clearAttempts($id)
    {
        return parent::deleteData($this->_table, ['field'=> 'user_id', 'value' => $id]);
    }


}