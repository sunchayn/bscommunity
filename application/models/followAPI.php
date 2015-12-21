<?php
/**
 * bloodstone community V1.0.0
 * followAPI Class !
 * an API to manage follow system
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class followAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'follow';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new followAPI(Controller::$db);
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
     * @param $id
     * @param array $where
     * @return mixed
     */
    public function getFollowers($id, $where = [])
    {
        $join = "LEFT JOIN users ON follow.`follower_id` = users.`id`";
        return parent::selectData('follow.*, users.id as uID, users.username, users.profile_picture, users.level', array_merge($where, [ ['following_id', '=', $id] ]), [$this->_table, $join], 'order by follow.`id`');
    }


    /**
     * @param $id
     * @param array $where
     * @return mixed
     */
    public function getFollowersWithPref($id, $where = [])
    {
        $join = "LEFT JOIN users_pref ON follow.`follower_id` = users_pref.`user_id`";
        return parent::selectData('*', array_merge($where, [ ['following_id', '=', $id] ]), [$this->_table, $join], null);
    }

    /**
     * @param $id
     * @param array $where
     * @param string $rows
     * @return mixed
     */
    public function getFollowing($id, $where = [], $rows = 'follow.*, users.id as uID, users.username, users.profile_picture, users.level')
    {
        $join = "LEFT JOIN users ON follow.`following_id` = users.`id`";
        return parent::selectData($rows, array_merge($where, [ ['follower_id', '=', $id] ]), [$this->_table, $join], 'order by follow.`id`');
    }

    /**
     * @param $id
     * @param array $where
     * @param string $rows
     * @return $this
     */
    public function getFollowingPaginator($id, $where = [], $rows = 'follow.*, users.username, users.profile_picture, users.level, threads.title, threads.id as TID, threads.create')
    {
        $join = "LEFT JOIN users ON follow.`following_id` = users.`id` LEFT JOIN threads ON follow.`following_id` = threads.`author_id`";
        return Paginator::getInstance()->getData([$this->_table, $join], 'feed', $rows, array_merge($where, [ ['follower_id', '=', $id], '(select id from threads where author_id = following_id limit 1)']), 'order by threads.`create` desc , threads.id desc');
    }

    /**
     * @param $id
     * @param $following
     * @return bool
     */
    public function isFollowing($id, $following)
    {
        return !empty(parent::selectData('*', [['following_id', '=', $following], ['follower_id', '=', $id]], $this->_table, null, 'LIMIT 1'));
    }

    /**
     * @param $id
     * @return bool
     */
    public function isFollowingWithCheck($id)
    {
        if (!usersAPI::isLogged())
            return false;
        return !empty(parent::selectData('*', [['following_id', '=', $id], ['follower_id', '=', Controller::$GLOBAL['logged']->id]], $this->_table, null, 'LIMIT 1'));
    }

    /**
     * @param $data
     * @return array|bool|string
     */
    public function follow($data)
    {
        Controller::$language->load('validation/follow');
        //-- check for errors
        if (!usersAPI::isLogged())
            return [Controller::$language->invokeOutput('frequent/badLogin')];
        $data['follower_id'] = Controller::$GLOBAL['logged']->id;
        //get following pref
        $following = usersAPI::getInstance()->getUserPreferences($data['following_id'], 'is_follow');
        if (!isset($data['following_id']) || empty(usersAPI::getInstance()->getUserById($data['follower_id'])) || $following === false)
            return [Controller::$language->invokeOutput('wrong')];
        //if he try to follow himself
        if ($data['follower_id'] == $data['following_id'])
            return [Controller::$language->invokeOutput('yourself')];
        //if already following
        if ($this->isFollowing($data['follower_id'], $data['following_id']))
            return [Controller::$language->invokeOutput('already')];
        //if the following disabled the follow feature
        if ((int)$following[0]->is_follow == 0)
            return [Controller::$language->invokeOutput('cant')];
        //while no error happened insert the following record
        $add = parent::insertData($this->_table, array_keys($data), array_values($data));
        if (!empty($add))
        {
            //notify follower
            notificationAPI::getInstance()->notifyFollowing($data['following_id'], $data['follower_id']);
            //show succeed message
            return Controller::$language->invokeOutput('followDone');
        }
        return false;
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function unfollow($data)
    {
        Controller::$language->load('validation/follow');
        //-- check for errors
        if (!usersAPI::isLogged())
            return [Controller::$language->invokeOutput('frequent/badLogin')];
        $data['follower_id'] = Controller::$GLOBAL['logged']->id;
        if (!isset($data['following_id']) || empty(usersAPI::getInstance()->getUserById($data['follower_id'])) || empty(usersAPI::getInstance()->getUserById($data['following_id'])))
            return [Controller::$language->invokeOutput('wrong')];
        $getFollowing = $this->getFollowing($data['follower_id'], [ ['following_id', '=', $data['following_id']] ], 'follow.id');
        if (empty($getFollowing))
            return [Controller::$language->invokeOutput('alreadyNot')];
        $getFollowing = $getFollowing[0];
        //---->
        return (parent::deleteData($this->_table, ['field'=> 'id', 'value' => $getFollowing->id])) ? Controller::$language->invokeOutput('unfollowDone') : false;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function loadFollowers($data = [])
    {
        $join = "LEFT JOIN users ON follow.`follower_id` = users.`id`";
        $_GET['page'] = isset($data['page']) ? intval($data['page']) : 1;
        return Paginator::getInstance()->getData([$this->_table, $join], 'fellow','follow.*, users.id as uID, users.username, users.profile_picture, users.level', [['following_id', '=', usersAPI::getLoggedId()]]);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function loadFollowings($data = [])
    {
        $join = "LEFT JOIN users ON follow.`following_id` = users.`id`";
        $_GET['page'] = isset($data['page']) ? intval($data['page']) : 1;
        return Paginator::getInstance()->getData([$this->_table, $join], 'fellow','follow.*, users.id as uID, users.username, users.profile_picture, users.level', [['follower_id', '=', usersAPI::getLoggedId()]]);
    }

}