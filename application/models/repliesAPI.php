<?php
/**
 * bloodstone community V1.0.0
 * usersAPI Class !
 * an API for the user table
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class repliesAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'replies';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new repliesAPI(Controller::$db);
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
     * @return mixed
     */
    public function getReplies($rows = "*", $where = null){
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getReplyByID($id, $row = "*")
    {
        return parent::selectData($row, [['id', '=', $id]], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getReplyWithAuthor($id, $row = "*")
    {
        $join = "LEFT JOIN users ON replies.`author_id` = users.`id`";
        return parent::selectData($row, [ ['replies.id', '=', $id] ], [$this->_table, $join], null, 'LIMIT 1', null);
    }

    /** get all replies in the given thread
     * @param $parent
     * @param string $row
     * @return mixed
     */
    public function getRepliesByParent($parent, $row = "*")
    {
        return parent::selectData($row, [['thread_id', '=', $parent]], $this->_table);
    }

    /** get all replies in the given thread with pagination system
     * @param $parentID
     * @param string $row
     * @return $this
     */
    public function getRepliesPaginator($parentID, $row = "*")
    {
        $order = Order::getOrder();
        return Paginator::getInstance()->getData($this->_table, "thread/{$parentID}", $row, [ ['thread_id', '=', $parentID] ], $order);
    }

    /**
     * @param $parentID
     * @param string $row
     * @return $this
     */
    public function getRepliesWithAuthor($parentID, $row = "*")
    {
        $join = "LEFT JOIN users ON replies.`author_id` = users.`id` LEFT JOIN access ON access.id = users.role";
        $order = Order::getOrder();
        return Paginator::getInstance()->getData([$this->_table, $join], "thread/{$parentID}", $row, [ ['thread_id', '=', $parentID] ], $order);
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getReplyWithParent($id, $rows = '*')
    {
        $join = 'LEFT JOIN threads ON threads.id = replies.thread_id';
        return parent::selectData($rows, [ ['replies.id', '=', $id] ], [$this->_table, $join], null, 'LIMIT 1', null);
    }

    /**
     * @param string $row
     * @return mixed
     */
    public function getLastReply($row = "*")
    {
        $join = "LEFT JOIN users ON replies.`author_id` = users.`id` LEFT JOIN threads ON replies.thread_id = threads.id";
        return parent::selectData($row, null, [$this->_table, $join], null, 'LIMIT 1');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function isExist($id)
    {
        return (count($this->getReplyByID($id)) == 0  ) ? false : true;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function createReply($data = array())
    {
        Controller::$language->load('validation/reply');
        if (!usersAPI::isLogged())
            return ['general' => [Controller::$language->invokeOutput("frequent/badLogin")]];
        //author id
        $data['author_id'] = Controller::$GLOBAL['logged']->id;
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['content','thread_id'];
        //array that hold errors
        $errors = [];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput("require")]];
        //if thread doesn't exist
        if (!threadsAPI::getInstance()->isExist(($data['thread_id'])))
            $errors['thread'][] =  Controller::$language->invokeOutput("no-thread");
        //if short content
        if (!isset(strip_tags($data['content'])[6]))
            $errors['content'][] =  Controller::$language->invokeOutput("content1");
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        //format the content
        $data['content'] = trim($data['content']);
        //add the reply
        $add = parent::insertData($this->_table, $fieldsArray, array_values($data));
        //update the author posts count
        if (!empty($add))
        {
            //add the date of the last insert to the thread
            threadsAPI::getInstance()->catchNewReply($data['thread_id']);
            //increment the user posts
            usersAPI::getInstance()->updateUserPosts($data['author_id']);
            //increment thread replies
            threadsAPI::getInstance()->updateThreadReplies($data['thread_id']);
            //notify author
            notificationAPI::getInstance()->notifyNewReply(intval($data['thread_id']));
            $xp = (isset(strip_tags($data['content'])[99])) ? 55 : 40;
            $gold = (isset(strip_tags($data['content'])[99])) ? 40  : 25;
            //add xp gain
            usersAPI::getInstance()->addExperience($data['author_id'], $xp);
            //add gold gain
            usersAPI::getInstance()->addGold($data['author_id'], $gold);
            //show done message
            return Controller::$language->invokeOutput("done");
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteReply($id)
    {
        Controller::$language->load('validation/reply');
        $reply = $this->getReplyByID($id, 'author_id, thread_id');
        $reply = (!empty($reply)) ? $reply[0] : false;
        if (!accessAPI::getInstance()->checkAccessToDeleteReply($reply->author_id))
            return [Controller::$language->invokeOutput("delete/no-access")];
        $delete = parent::deleteData($this->_table, ['field'=> 'id', 'value' => $id]);
        if (!empty($delete))
        {
            //decrement users posts
            usersAPI::getInstance()->updateUserPosts($reply->author_id, false);
            //decrement threads replies
            threadsAPI::getInstance()->updateThreadReplies($reply->thread_id, false);
            //return succeeds message
            return Controller::$language->invokeOutput("delete/done");
        }
        return false;
    }

    /**
     * @param $threadID
     * @return mixed
     */
    public function deleteRepliesByParent($threadID)
    {
        $getAllReplies = $this->getRepliesByParent($threadID);
        $delete = parent::deleteData($this->_table, ['field'=> 'thread_id', 'value' => $threadID]);;
        foreach ($getAllReplies as $reply)
        {
            //decrement users posts
            usersAPI::getInstance()->updateUserPosts($reply->author_id, false);
            //decrement threads replies
            threadsAPI::getInstance()->updateThreadReplies($threadID, false);
        }
        return $delete;
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function updateReply($data = array())
    {
        Controller::$language->load('validation/reply');
        if (empty($data))
            return false;
        //get the array of fields
        $getReply = $this->getReplyByID($data['id'], 'content, author_id, thread_id');
        if (empty($getReply))
            return ['general' => [Controller::$language->invokeOutput("frequent/wrong")]];
        $getReply = $getReply[0];
        $requireData = ['id'];
        $errors = [];
        $values = [];
        //seek for errors
        if (!empty(array_diff($requireData, array_keys($data))))
            ['general' => Controller::$language->invokeOutput("require")];
        //if no access
        if (!accessAPI::getInstance()->checkAccessToUpdateReply($getReply->author_id))
            return ['general' => [Controller::$language->invokeOutput("frequent/no-access")]];
        if (!threadsAPI::getInstance()->isExist($getReply->thread_id))
            $errors['general'][] =  Controller::$language->invokeOutput("no-thread");
        if (isset($data['content']) && trim($data['content']) != $getReply->content)
        {
            //if short content
            if (!isset(strip_tags($data['content'])[6]))
                $errors['content'][] = Controller::$language->invokeOutput("content1");
            $values['content'] = trim($data['content']);
        }
        //if there's no changes
        if (empty($values))
            return ['general' => [Controller::$language->invokeOutput("frequent/no-change")]];
        //if there's an errors
        if (!empty($errors))
            return $errors;
        //update the reply
        return (parent::updateData($this->_table, ['field' => 'id', 'value' => $data['id']], $values)) ? Controller::$language->invokeOutput("update/done") : false;
    }

    /**
     * @param $id
     * @param bool $positive
     * @return array|bool|mixed|string
     */
    public function rateReply($id, $positive = true)
    {
        Controller::$language->load('validation/rate');
        //get the logged user id
        $currentUser = isset_get(Controller::$GLOBAL, 'loggedID', false);
        if ($currentUser === false)
            return [Controller::$language->invokeOutput("not-login")];
        //fetch the reply
        $getReply = $this->getReplyByID($id, 'rate, author_id');
        //if id doesn't exist return false
        if (count($getReply) == 0)
            return [Controller::$language->invokeOutput("not-login")];
        $getReply = $getReply[0];
        //if user try to rate his reply
        if ($getReply->author_id == $currentUser)
            return [Controller::$language->invokeOutput("yourself")];
        //tell if the user has a previous rate
        $getRate = rateReplyAPI::getInstance()->getUserRate($id, $currentUser);
        //increase or decrease rate
        $newRate = ($positive) ? ++$getReply->rate : --$getReply->rate;
        if (empty($getRate))
        {
            //add the user to the rate table
            rateReplyAPI::getInstance()->insertRate([$id, $currentUser, $positive]);
            //update the row and return the result
            return (parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['rate' => $newRate])) ? Controller::$language->invokeOutput("done") : [Controller::$language->invokeOutput("frequent/wrong")];
        }else{
            if ($getRate[0]->value == $positive)
                return [Controller::$language->invokeOutput("already")];
            //update the user rate value
            rateReplyAPI::getInstance()->updateRate($getRate[0]->id, $positive);
            //update the row and return the result
            return ( parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['rate' => $newRate])) ? Controller::$language->invokeOutput("done") : [Controller::$language->invokeOutput("frequent/wrong")];
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForumsReplies($id)
    {
        $id = intval((int)$id);
        $whereInject = "thread_id IN (SELECT id FROM threads WHERE forum_id = {$id})";
        return parent::selectData("count(*) as cnt", [ $whereInject ], $this->_table)[0]->cnt;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryReplies($id)
    {
        $id = intval((int)$id);
        $whereInject = "thread_id IN (SELECT id FROM threads WHERE forum_id IN (SELECT id FROM forums WHERE cat_id = '{$id}'))";
        return parent::selectData("count(*) as cnt", [ $whereInject ], $this->_table)[0]->cnt;
    }

}