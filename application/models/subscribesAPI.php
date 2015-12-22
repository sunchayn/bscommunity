<?php
/**
 * bloodstone community V1.0.0
 * attemptAPI Class !
 * an API to handle support tickets
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class subscribesAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'subscribes';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new subscribesAPI(Controller::$db);
        }
        return self::$_instance;
    }
    /**
     * define the database variable when call this class
     * @param $db
     */
    public function __construct($db){
        $this->setDataBase($db);
    }

    /**
     * @param null $where
     * @param string $rows
     * @param null $order
     * @param null $limit
     * @return mixed
     */
    public function getSubscribes($where = null, $rows = "*", $order = null, $limit = null)
    {
        return parent::selectData($rows, $where, $this->_table, $order, $limit);
    }

    /**
     * @param $priority
     * @param string $rows
     * @param null $order
     * @param null $limit
     * @return mixed
     */
    public function getSubscribersByPriority($priority, $rows = "*", $order = null, $limit = null)
    {
        return $this->getSubscribes([ ['priority', '=', $priority] ],$rows, $order, $limit);
    }

    /**
     * @param $email
     * @return bool
     */
    public function issetEmail($email)
    {
        return !empty(parent::selectData('*', [ ['email', '=', $email] ], $this->_table, null, 'limit 1'));
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function addSubscriber($data = array())
    {
        Controller::$language->load('validation/subscribes');
        if (!isset($data['email']))
            return [Language::invokeOutput('missing')];
        //if email already used
        if ($this->issetEmail($data['email']))
            return [Language::invokeOutput('already')];
        //if the email is wrong
        if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
            return [Language::invokeOutput('wrong-mail')];
        //set the priority
        $data['priority'] = ( empty(usersAPI::getInstance()->getUserByEmail($data['email'])) ) ? 0 : 1;
        $data['hash'] = Hash::generate($data['email'], Hash::salt(32));
        return (parent::insertData($this->_table, array_keys($data), array_values($data))) ? language::invokeOutput('done') : false;
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function unSubscribe($hash)
    {
        return parent::deleteData($this->_table, ['field' => 'hash', 'value' => $hash]);
    }
}