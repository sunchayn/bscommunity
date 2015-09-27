<?php
/**
 * bloodstone community V1.0.0
 * usersAPI Class !
 * an API for the user table
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class threadsAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'threads';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new threadsAPI(Controller::$db);
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
    public function getThreads($rows = "*", $where = null){
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param string $row
     * @param null $where
     * @param int $limit
     * @param bool|false $author
     * @return mixed
     */
    public function getLastThreads($row = "*", $where = null, $limit = 1, $author = false)
    {
        if ($author)
        {
            $join = "LEFT JOIN users on {$this->_table}.author_id = users.id";
            return parent::selectData($row, $where, [$this->_table, $join],  'order by id desc', "LIMIT {$limit}");
        }
        return parent::selectData($row, $where, $this->_table, 'order by id desc', "LIMIT {$limit}");
    }

    /**
     * @param forumTitle
     * @param string $row
     * @return mixed
     */
    public function getThreadByTitle($threadTitle, $row = "*")
    {
        return parent::selectData($row, [['title', '=', $threadTitle]], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getThreadByID($id, $row = "*")
    {
        return parent::selectData($row, [['id', '=', $id]], $this->_table, null, ' LIMIT 1');
    }
    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getThreadsByParentID($id, $row = "*")
    {
        return parent::selectData($row, [['forum_id', '=', $id]], $this->_table);
    }

    /** get all normal threads in current forum
     * @param $parentID
     * @param string $row
     * @return mixed
     */
    public function getNormalThreads($parentID, $row = "*")
    {
        return parent::selectData($row, [['forum_id', '=', $parentID], ['status', '=', '1']], $this->_table);
    }

    /** get all normal threads in the current page&forum
     * @param $parentID
     * @param string $row
     * @return $this
     */
    public function getNormalThreadsPaginator($parentID, $row = "*")
    {
        $order = Order::getOrder(true, false);
        return Paginator::getInstance()->getData($this->_table, "forum/{$parentID}", $row, [['forum_id', '=', $parentID], ['status', '=', '1']], $order);
    }

    /**
     * @param $id
     * @param bool|true $pin
     * @return array|bool|null|string
     */
    public function pinUnpin($id, $pin = true)
    {
        Controller::$language->load('validation/thread');
        if (!accessAPI::getInstance()->checkAccessToPin())
            return [Controller::$language->invokeOutput('frequent/no-access')];
        $getThread = $this->getThreadByID($id, 'author_id');
        if (empty($getThread))
            return false;
        if ($pin)
        {
            $action = parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 2]);
            if ($action)
            {
                //notify author
                notificationAPI::getInstance()->notifyThreadPin($getThread[0]->author_id, $id);
                //show succeed message
                return Controller::$language->invokeOutput("pin");
            }

            return false;
        }

        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 1])) ? Controller::$language->invokeOutput('unpin') : false;
    }

    /**
     * @param $author
     * @param $forum
     * @param string $row
     * @return $this
     */
    public function getThreadsByAuthorForums($author, $forum, $row = "forums.title as ft, forums.id as fi, threads.*")
    {
        $join = "LEFT JOIN forums ON threads.`forum_id` = forums.`id`";
        if ($forum === false)
            return Paginator::getInstance()->getData([$this->_table, $join], "profile/threads/{$author}", $row, [['author_id', '=', $author], 'threads.status > 0'], 'ORDER BY threads.id DESC');
        return Paginator::getInstance()->getData([$this->_table, $join], "profile/threads/{$author}", $row, [['author_id', '=', $author] , ['forum_id', '=', $forum]], 'ORDER BY threads.id DESC');
    }

    /**
     * @param $id
     * @param $forum
     * @return mixed
     */
    public function getAuthorThreadsToday($id, $forum)
    {
        return parent::selectData('count(*) as c', [ ['author_id', '=', $id], ['forum_id', '=', $forum], '`create` > DATE_SUB(NOW(), INTERVAL 24 HOUR)'], $this->_table)[0]->c;
    }

    /** get all pinned threads in current forum
     * @param $parentID
     * @param string $rows
     * @return mixed
     */
    public function getPinnedThreads($parentID, $rows = "*")
    {
        $order = Order::getOrder();
        return parent::selectData($rows, [['forum_id', '=', $parentID], ['status', '=', '2']], $this->_table, $order);
    }

    /**
     * @param $search
     * @param string $row
     * @return $this
     */
    public function getThreadSearchPaginator($search, $row = 'threads.title, threads.id as TID,users.username, users.id as UID, users.profile_picture, users.level')
    {
        $join = "LEFT JOIN users on {$this->_table}.author_id = users.id";
        return Paginator::getInstance()->getData([$this->_table, $join], 'search?q='.$search, $row, [['title', 'like', '%'.$search.'%'], 'threads.status > 0'], 'ORDER BY threads.id DESC', '&');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function isExist($id)
    {
        return (count($this->getThreadByID($id)) == 0  ) ? false : true;
    }

    /**
     * @param $title
     * @return bool
     */
    public function isTitleExist($title)
    {
        return (count($this->getThreadByTitle($title)) == 0  ) ? false : true;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function createThread($data = array())
    {
        Controller::$language->load('validation/thread');
        $data['author_id'] = Controller::$GLOBAL['logged']->id;
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['title','content','forum_id','keywords'];
        if ( !empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput("require")]];
        //get the forum
        $forum = forumsAPI::getInstance()->getForumByID($data['forum_id']);
        //if forum doesn't exist
        if (empty($forum))
            return ['general' => [Controller::$language->invokeOutput("no-forum")]];
        if ($forum[0]->status == 0)
            return ['general' => [Controller::$language->invokeOutput("closed-forum")]];
        //array that hold errors
        $errors = [];
        // -- check for errors
        //if short title
        if (mb_strlen($data['title'], 'UTF-8') < 6)
            $errors['title'][] =  Controller::$language->invokeOutput("title1");
        //if title have disallowed words
        if (Validation::isRestrictEntry($data['title'], Controller::$db))
            $errors['title'][] =  Controller::$language->invokeOutput("title2");
        $data['content'] = renderOutput(htmlspecialchars_decode($data['content']));
        //if short content
        if (mb_strlen(strip_tags($data['content']), 'UTF-8') < 6)
            $errors['content'][] =  Controller::$language->invokeOutput("content1");
        if (mb_strlen($data['keywords'], 'UTF-8') != 0)
        {
            if (!preg_match('/^([A-z\s\d,])+$/', $data['keywords']))
                $errors['keywords'][] =  Controller::$language->invokeOutput("keywords");
            $data['keywords'] = preg_replace('/[\s]*,+[\s]*/u', ',', trim($data['keywords']));
        }
        // -- end check for errors
        //if an error has occurred return
        if (!empty($errors))return $errors;
        //check if the user doesn't exceed the limit
        $getLimitThreads = variablesAPI::getInstance()->getVariableValue('limit', 'threads');
        if ($this->getAuthorThreadsToday($data['author_id'], $data['forum_id']) >= $getLimitThreads)
        {
            //check if the user have a thread breaker
            $getItem = inventoryAPI::getInstance()->getActiveItem(4, $data['author_id']);
            if (!empty($getItem))
            {
                inventoryAPI::getInstance()->useItem($getItem[0]->id);
            }else{
                return ['general' => [Controller::$language->invokeOutput("exceed-limit")]];
            }
        }
        //create the thread
        $add = (parent::insertData($this->_table, $fieldsArray, array_values($data)));
        $id = Controller::$db->lastInsertId();
        if (!empty($add))
        {
            //increment the user posts
            usersAPI::getInstance()->updateUserPosts($data['author_id']);
            //increment forum replies
            forumsAPI::getInstance()->updateForumThreads($data['forum_id']);
            //notify follower
            notificationAPI::getInstance()->notifyFollowersThread($id, $data['author_id']);
            //add xp gain
            usersAPI::getInstance()->addExperience($data['author_id'], 85);
            //add gold gain
            usersAPI::getInstance()->addGold($data['author_id'], 60);
            //show succeed message
            return Controller::$language->invokeOutput("done");
        }
        return false;
    }

    /**
     * @param $id
     * @param bool|true $decrement
     * @return bool
     */
    public function deleteThread($id, $decrement = true)
    {
        $get = $this->getThreadByID($id, 'forum_id')[0]->forum_id;
        //first of all delete all replies threads
        if (!repliesAPI::getInstance()->deleteRepliesByParent($id)) return false;
        //if process succeed delete the thread
        if (parent::deleteData($this->_table,['field'=> 'id', 'value' => $id]))
        {
            //decrement forum threads count
            if ($decrement)
                forumsAPI::getInstance()->updateForumThreads($get, false);
            return true;
        }
        return false;
    }

    /**
     * @param array $data
     * @return array|mixed|string
     */
    public function updateThread($data = array())
    {
        Controller::$language->load('validation/thread');
        if (empty($data)) return false;
        $getThread = $this->getThreadByID($data['id'], 'title, content, keywords, author_id');
        if (empty($getThread))
            return ['general' => [Controller::$language->invokeOutput("frequent/wrong")]];
        $getThread = $getThread[0];
        $errors = [];
        $values = [];
        //seek for errors
        //if no access
        if (!accessAPI::getInstance()->checkAccessToUpdateThread($getThread->author_id))
            return ['general' => [Controller::$language->invokeOutput("frequent/no-access")]];
        if (isset($data['title']) && $data['title'] != $getThread->title)
        {
            //if short title
            if (!isset($data['title'][6]))
                $errors['title'][] = Controller::$language->invokeOutput("title1");
            //if title have disallowed words
            if (Validation::isRestrictEntry($data['title'], Controller::$db))
                $errors['title'][] = Controller::$language->invokeOutput("title2");
            $values['title'] = $data['title'];
        }
        if (isset($data['content']) && $data['content'] != $getThread->content)
        {
            $data['content'] = renderOutput(htmlspecialchars_decode($data['content']));
            //if short content
            if (!isset(strip_tags($data['content'])[6]))
                $errors['content'][] = Controller::$language->invokeOutput("content1");
            $values['content'] = $data['content'];
        }
        if (isset($data['keywords']) && $data['keywords'] != $getThread->keywords)
        {
            if (!preg_match('/^([A-z\s\d,])+$/', $data['keywords']))
                $errors['keywords'][] = Controller::$language->invokeOutput("keywords");
            $values['keywords'] = preg_replace('/[\s]*,+[\s]*/u', ',', trim($data['keywords']));
        }
        //if nothing changes
        if (empty($values))
            return ['general' => [Controller::$language->invokeOutput("frequent/no-change")]];
        //if there's an error
        if (!empty($errors))
            return $errors;
        //update the thread
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $data['id']], $data)) ? Controller::$language->invokeOutput("update/done") : false;
    }

    /** increment the views of the current thread
     * @param $id
     * @return mixed
     */
    public function updateView($id)
    {
        $viewedThreads = Session::get("threadsView");
        if (!$viewedThreads || (is_array($viewedThreads) && !in_array($id, $viewedThreads) ) )
        {
            if (Session::setArray("threadsView", $id))
                return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['views' => ['views + 1']]);
        }
    }

    /** increment/decrement the replies count of the current thread
     * @param $id
     * @param bool|true $increase
     * @return mixed
     */
    public function updateThreadReplies($id, $increase = true)
    {
            $forum = $this->getThreadByID($id, 'forum_id')[0]->forum_id;
            ($increase) ?
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['replies' => ['replies + 1']]):
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['replies' => ['replies - 1']]);
            ($increase) ?
            parent::updateData('forums', ['field' => 'id', 'value' => $forum], ['replies' => ['replies + 1']]):
            parent::updateData('forums', ['field' => 'id', 'value' => $forum], ['replies' => ['replies - 1']]);
    }

    /** update the last reply timestamp
     * @param $id
     * @return mixed
     */
    public function catchNewReply($id)
    {
        return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['last_reply' => ['NOW()'] ]);
    }

}