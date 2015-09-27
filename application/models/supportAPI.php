<?php
/**
 * bloodstone community V1.0.0
 * attemptAPI Class !
 * an API to handle support tickets
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class supportAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'support';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new supportAPI(Controller::$db);
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
     * @param string $rows
     * @param null $where
     * @return mixed
     */
    public function getTickets($rows = '*', $where = null)
    {
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @return bool
     */
    public function issetUnread()
    {
        return !empty(parent::selectData('id', ['seen = 0'], $this->_table, null, 'LIMIT 1'));
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getTicketById($id, $rows = 'users.username, users.level, users.profile_picture, support.*')
    {
        $join = "LEFT JOIN users ON support.sender = users.id";
        return parent::selectData($rows, [ ['support.id', '=', $id] ], [$this->_table, $join], null, 'LIMIT 1', null);
    }

    /**
     * @param string $rows
     * @return $this
     */
    public function getTicketsPaginator($rows = 'users.username, support.*')
    {
        $order = Order::getOrder(true, null, 'BSCOSNS');
        $join = "LEFT JOIN users ON support.sender = users.id";
        return Paginator::getInstance()->getData([$this->_table, $join], "support", $rows, null, $order);
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function sendTicket($data)
    {
        Controller::$language->load('validation/support');
        //set the required fields
        $requireData = ['content', 'title'];
        //get the logged user id
        $data['sender'] = isset_get(Controller::$GLOBAL, 'loggedID', false);
        //get the array of fields
        $fieldsArray = array_keys($data);
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return [ 'general' => [Controller::$language->invokeOutput("require")]];
        if ($data['sender'] === false)
            return [ 'general' => [Controller::$language->invokeOutput("frequent/badLogin")]];
        //if short title
        if (!isset($data['title'][6]))
            $errors['title'][] =  [Controller::$language->invokeOutput("title1")];
        if (Validation::isRestrictEntry($data['title'], Controller::$db))
            $errors['title'][] =  [Controller::$language->invokeOutput("title2")];
        //if short content
        if (!isset($data['content'][6]))
            $errors['content'][] =  [Controller::$language->invokeOutput("content1")];
        //if content have disallowed words
        if (Validation::isRestrictEntry($data['content'], Controller::$db))
            $errors['content'][] =  [Controller::$language->invokeOutput("content2")];
        // -- end check for errors
        if (!empty($errors))
            return $errors;
        //send the message
        return (parent::insertData($this->_table, $fieldsArray, array_values($data))) ? Controller::$language->invokeOutput('done') : false;
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function responseTicket($data)
    {
        Controller::$language->load('validation/support');
        //set the required fields
        $requireData = ['content', 'id'];
        if (!empty(array_diff($requireData, array_keys($data))))
            return [ 'general' => [Controller::$language->invokeOutput("require")]];
        $getTicket = $this->getTicketById($data['id']);
        if (empty($getTicket))
            return false;
        $getTicket = $getTicket[0];
        $data['title'] = $getTicket->title;
        $errors = [];
        //check for errors
        //if the ticked is closed
        if ($getTicket->status == 1)
            return [ 'general' => [Controller::$language->invokeOutput("closed")]];
        //if short content
        if (!isset($data['content'][6]))
            $errors['content'][] =  [Controller::$language->invokeOutput("content1")];
        //if content have disallowed words
        if (Validation::isRestrictEntry($data['content'], Controller::$db))
            $errors['content'][] =  [Controller::$language->invokeOutput("content2")];
        if (!empty($errors))
            return $errors;
        $insert = parent::insertData('inbox', ['sender', 'receiver', 'content', 'title'], ['0000', $getTicket->sender, $data['content'], $data['title']]);
        if ($insert) {
            parent::updateData($this->_table, ['field' => 'id', 'value' => $data['id']], [ 'status' => ['1'] ]);
            return Controller::$language->invokeOutput('response') ;
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTicket($id)
    {
        return parent::deleteData($this->_table, ['field' => 'id', 'value' => $id]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function seeTicket($id)
    {
        return parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['seen' => ['1']]);
    }
}