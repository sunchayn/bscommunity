<?php
/**
 * bloodstone community V1.0.0
 * inboxAPI Class !
 * an API for messages between users
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class inboxAPI extends databaseAPI
{
    /**
     * @var  string
     */
    private $_table = 'inbox';

    private static $_instance = null;

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new inboxAPI(Controller::$db);
        }
        return self::$_instance;
    }

    /**
     * define the database variable when call this class
     * @param $db
     */
    function __construct($db)
    {
        $this->setDataBase($db);
    }

    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getMessageById($id, $row = 'inbox.*, users.id as uID, users.username, users.level, users.profile_picture')
    {
        $join = "LEFT JOIN users ON inbox.`sender` = users.`id`";
        return parent::selectData($row, [ ["inbox.`id`", "=", $id] ], [$this->_table, $join], null, 'LIMIT 1', '');
    }

    /**
     * @param $parentID
     * @param string $row
     * @return mixed
     */
    public function getSubMessages($parentID, $row = 'inbox.*, users.id as uID, users.username, users.level, users.profile_picture')
    {
        $join = "LEFT JOIN users ON inbox.`sender` = users.`id`";
        return parent::selectData($row, [ ["inbox.`sub_inbox`", "=", $parentID] ], [$this->_table, $join], 'ORDER BY id', null, '');
    }

    /**
     * @param $id
     * @param string $row
     * @param bool|false $paginator
     * @param string $param
     * @return $this
     */
    public function getUserOutbox($id, $paginator = false, $param = '?', $row = 'inbox.*, users.username')
    {
        $join = "LEFT JOIN users ON inbox.`receiver` = users.`id`";
        $row .= ", (CASE
        WHEN isnull(last_response) THEN inbox.date
        ELSE last_response END) AS orderType";
        if ($paginator)
            return Paginator::getInstance()->getData([$this->_table, $join], "inbox", $row, [ ["sender", "=", $id], "sub_inbox = 0 AND is_sen_del = 0" ], 'ORDER BY orderType DESC', $param);
        return parent::selectData($row, [ ["sender", "=", $id], "sub_inbox = 0 AND is_sen_del = 0"], [$this->_table, $join]);
    }

    /**
     * @param $id
     * @param string $row
     * @param bool|false $paginator
     * @param string $param
     * @return $this
     */
    public function getUserInbox($id, $paginator = false, $param = '?',$row = 'in2.*, users.username')
    {
        $join = "LEFT JOIN users ON in2.`sender` = users.`id`";
        $row .= ", (CASE
        WHEN isnull(in2.last_response) THEN in2.date
        ELSE in2.last_response END) AS orderType";
        $injectWhere = "(in1.sub_inbox = in2.id AND (in1.receiver = {$id} AND in2.sender = {$id}) AND in2.is_sen_del = 0)
        OR (in2.sub_inbox = 0 AND in2.receiver = {$id} AND in2.is_rec_del = 0)
        GROUP BY in2.id";
        if ($paginator)
            return Paginator::getInstance()->getData(["{$this->_table} as in1, {$this->_table} as in2", $join], "inbox", $row, [$injectWhere], 'ORDER BY orderType DESC', $param);
        return parent::selectData($row, [$injectWhere], ["{$this->_table} as in1, {$this->_table} as in2", $join]);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getUserOutBoxToday($user)
    {
        return parent::selectData('count(*) as c', [ ['sender', '=', $user], '`date` > DATE_SUB(NOW(), INTERVAL 24 HOUR)'], $this->_table)[0]->c;
    }
    /**
     * @param $id
     * @param $isSender
     * @return mixed
     */
    public function deleteInbox($id, $isSender)
    {
        return ($isSender) ? parent::updateData($this->_table, ['field'=>'id', 'value' => $id], ['is_sen_del' => 1])
                           : parent::updateData($this->_table, ['field'=>'id', 'value' => $id], ['is_rec_del' => 1]);
    }

    /**
     * @param $user
     * @param string $row
     * @return bool
     */
    public function getUserUnreadMsg($user, $row = 'inbox.*, users.username')
    {
       $sql = "SELECT
                    {$row}
                FROM
                    inbox
                        LEFT JOIN
                    users ON inbox.`sender` = users.`id`
                WHERE
                    sub_inbox = 0
                        AND ((is_rec_read = 0 AND receiver = ? AND is_rec_del = 0)
                        OR (sender = ? AND has_response = 1  AND is_sen_del = 0))";
        return parent::executeQuery($sql, [$user, $user]);
    }

    /**
     * @param $user
     * @return array
     */
    public function getFormedInbox($user)
    {
        $inbox = $this->getUserUnreadMsg($user);
        $inboxArray = [];
        foreach ($inbox as $msg)
        {
            if (isset($msg->title[31]))
                $msg->title = mb_substr($msg->title, 0, 30, 'UTF-8') . '...';
            if (isset($msg->content[70]))
                $msg->content = mb_substr($msg->content, 0, 50, 'UTF-8') . '...';
            if ($msg->sender === '0')
                $msg->username = Controller::$language->invokeOutput('frequent/administration');
            elseif (is_null($msg->username))
                $msg->username = Controller::$language->invokeOutput('undefined');
            $inboxArray[] = $msg;
        }

        return $inboxArray;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function makeUnread($id)
    {
        return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['is_rec_read' => 0]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function makeRead($id)
    {
        return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['is_rec_read' => 1]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function seeResponse($id)
    {
        return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['has_response' => false]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function catchResponse($id)
    {
        return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['has_response' => true]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function catchResponseDate($id)
    {
        return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['last_response' => ['NOW()'] ]);

    }

    /**
     * @param $fields
     * @param $values
     * @param $user
     * @return bool|string
     */
    public function insertMessage($fields, $values, $user)
    {
        //check if the user doesn't exceed the limit
        $getLimitMessages = variablesAPI::getInstance()->getVariableValue('limit', 'messages');
        if ($this->getUserOutBoxToday($user) >= $getLimitMessages)
        {
            //check if the user have a messages breaker
            $getItem = inventoryAPI::getInstance()->getActiveItem([5,6], $user);
            if (!empty($getItem))
            {
                inventoryAPI::getInstance()->useItem($getItem[0]->id);
            }else{
                return 'limit';
            }
        }
        return parent::insertData($this->_table, $fields, $values);
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function sendMessage($data)
    {
        Controller::$language->load('validation/inbox');
        //set the required fields
        $requireData = ['receiver','content', 'title'];
        //get the logged user id
        $data['sender'] = isset_get(Controller::$GLOBAL, 'loggedID', false);
        //get the array of fields
        $fieldsArray = array_keys($data);
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return [ 'general' => [Controller::$language->invokeOutput("require")]];
        if ($data['sender'] === false)
            return [ 'general' => [Controller::$language->invokeOutput("frequent/badLogin")]];
        if ($data['sender'] == $data['receiver'])
            $errors['receiver'][] =  [Controller::$language->invokeOutput("receiver1")];
        //if receiver id doesn't exist
        if (!usersAPI::getInstance()->isExist($data['receiver']))
            $errors['receiver'][] =  [Controller::$language->invokeOutput("receiver2")];
        //if short content
        if (mb_strlen($data['title'], 'UTF-8') < 6)
            $errors['title'][] =  [Controller::$language->invokeOutput("title1")];
        if (Validation::isRestrictEntry($data['title'], Controller::$db))
            $errors['title'][] =  [Controller::$language->invokeOutput("title2")];
        //if short content
        if (mb_strlen($data['content'], 'UTF-8') < 6)
            $errors['content'][] =  [Controller::$language->invokeOutput("content1")];
        //if content have disallowed words
        if (Validation::isRestrictEntry($data['content'], Controller::$db))
            $errors['content'][] =  [Controller::$language->invokeOutput("content2")];
        // -- end check for errors
        if (!empty($errors)) return $errors;
        //send the message
        $send = $this->insertMessage($fieldsArray,array_values($data), $data['sender']);
        if (is_string($send))
            return ['general' => [Controller::$language->invokeOutput("exceed-limit")]];
        return ($send) ? Controller::$language->invokeOutput("done2") : [Controller::$language->invokeOutput('frequent/wrong')];

    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function responseMessage($data)
    {
        Controller::$language->load('validation/inbox');
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['content','id'];
        //array that hold errors
        $errors = [];
        //check for errors
        if ( !empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput("require")]];
        $getParent = inboxAPI::getInstance()->getMessageById($data['id'], 'title, sender, receiver');
        // -- check for errors
        //if forum doesn't exist
        if (empty($getParent))
            return ['general' => [Controller::$language->invokeOutput("no-msg")]];
        $getParent = $getParent[0];
        //if short content
        if (mb_strlen($data['content'], 'UTF-8') < 6)
            $errors['content'][] =  Controller::$language->invokeOutput("content1");
        //if content have disallowed words
        if (Validation::isRestrictEntry($data['content'], Controller::$db))
            $errors['content'][] =  Controller::$language->invokeOutput("content2");
        // -- end check for errors
        //if an error has occurred return
        if (!empty($errors))return $errors;
        //add the response
        $data['title'] = $getParent->title;
        $data['sender'] = Controller::$GLOBAL['logged']->id;
        $data['receiver'] = $getParent->sender;
        $data['sub_inbox'] = $data['id'];
        unset($data['id']);
        //$response = parent::insertData($this->_table, array_keys($data), array_values($data));
        //send the response
        $response = $this->insertMessage( array_keys($data),array_values($data), $data['sender']);
        if (is_string($response))
            return ['general' => [Controller::$language->invokeOutput("exceed-limit")]];
        if ($response)
        {
            //add the date of the last insert to the parent message
            inboxAPI::getInstance()->catchResponseDate($data['sub_inbox']);
            //update the state of seen to unread
            if ($data['sender'] === $getParent->receiver)
                $this->catchResponse($data['sub_inbox']);
            else
                $this->makeUnread($data['sub_inbox']);

            return Controller::$language->invokeOutput("done");
        }

        return false;
    }
}