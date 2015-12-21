<?php
/**
 * bloodstone community V1.0.0
 * notificationAPI Class !
 * an API for notification system for members
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class notificationAPI extends databaseAPI
{
    /**
     * @var  string
     */
    private $_table = 'notification';

    private static $_instance = null;

    /**
     * @return notificationAPI|null
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new notificationAPI(Controller::$db);
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
    public function getNotifications($id, $row = "*")
    {
        return parent::selectData($row, [ ["receiver", "=", $id], ["seen", "=", 0] ], $this->_table);
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getNotificationById($id, $rows = '*')
    {
        return parent::selectData($rows, [ ["id", "=", $id] ], $this->_table);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function addNotification($data = array())
    {
        return parent::insertData( $this->_table, array_keys($data), array_values($data) );
    }

    /**
     * @return bool|mixed
     */
    public function seeNotifications()
    {
        if (!usersAPI::isLogged())
            return false;
        return parent::updateData($this->_table, ['field'=>'receiver', 'value' => Controller::$GLOBAL['logged']->id], ['seen' => '1']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteNotification($id)
    {
        return parent::deleteData($this->_table, ['field' => 'id', 'value' => $id]);
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function seeAllUserNotifications($user_id)
    {
        return parent::updateData($this->_table, ['field'=>'receiver', 'value' => $user_id], ['seen' => '1']);
    }

    /**
     * @param $id
     * @return array
     */
    public static function getNotificationsArray($id)
    {
        Controller::$language->load('notifications');
        $notifications = [];
        //fetch all unseen notifications
        $getNotifications = notificationAPI::getInstance()->getNotifications( $id );
        //fit results to the what the View expect
        foreach($getNotifications as $notify)
        {
            switch ($notify->action)
            {
                case 0:
                    $query = usersAPI::getInstance()->getUserById($notify->action_id, "username");
                    $user = (!empty($query)) ? $query[0]->username : 'undefined user';
                    $url = "profile/" . $notify->action_id;
                    $content = "<strong>{$user}</strong> ".language::invokeOutput('following');
                    break;
                case 1:
                    $url = "profile/" . $notify->receiver;
                    $content = language::invokeOutput('level')." <strong>{$notify->action_id}</strong>";
                    break;
                case 2:
                    $url = "thread/" . $notify->action_id;
                    $query = threadsAPI::getInstance()->getThreadByID($notify->action_id, "title, author_id");
                    $thread = (!empty($query)) ? $query[0] : [];
                    $query = usersAPI::getInstance()->getUserById($thread->author_id, "username");
                    $user = (!empty($query)) ? $query[0]->username : language::invokeOutput('frequent/undefined');
                    $content = "{$user} ". language::invokeOutput('createThread') ." <strong>{$thread->title}</strong>";
                    break;
                case 3:
                    $url = "thread/" . $notify->action_id;
                    $query = threadsAPI::getInstance()->getThreadByID($notify->action_id, "title");
                    if (empty($query))
                        continue 2;
                    $thread = $query[0];
                    $content = language::invokeOutput('pinned')."<strong>{$thread->title}</strong>";
                    break;
                case 4:
                    $url = "thread/" . $notify->action_id;
                    $query = threadsAPI::getInstance()->getThreadByID($notify->action_id, "title");
                    if (empty($query))
                        continue 2;
                    $thread = $query[0];
                    $content = language::invokeOutput('yh')." {$notify->stuck} " . language::invokeOutput('replies') . " <strong>{$thread->title}</strong>";
                    break;
                case 5:
                    $url = "thread/" . $notify->action_id;
                    $query = threadsAPI::getInstance()->getThreadByID($notify->action_id, "title");
                    if (empty($query))
                        continue 2;
                    $thread = $query[0];
                    $content = language::invokeOutput('yh')." {$notify->stuck} " . language::invokeOutput('thanks') . " <strong>{$thread->title}</strong>";
                    break;
                default:
                    $url = "E404";
                    $content = "undefined notification";
            }
            $notifications[] = ['content' => $content, 'url' => $url];
        }
        return $notifications;
    }

    /**
     * @param $thread
     * @param $author
     */
    public function notifyFollowersThread($thread, $author)
    {
        //get followers that wants notifications on threads
        $getFollowers = followAPI::getInstance()->getFollowersWithPref($author, ['notify_threads = 1']);
        foreach ($getFollowers as $follower)
            $this->addNotification(['receiver' => $follower->user_id, 'action' => 2, 'action_id' => $thread]);
    }

    /**
     * @param $following
     * @param $follower
     */
    public function notifyFollowing($following, $follower)
    {
        $getPref = usersAPI::getInstance()->getUserPreferences($following, 'notify_follow');
        if (!empty($getPref) && $getPref[0]->notify_follow == 1)
            $this->addNotification(['receiver' => $following, 'action' => 0, 'action_id' => $follower]);
    }

    /**
     * @param $author
     * @param $thread
     */
    public function notifyThreadPin($author, $thread)
    {
        $getPref = usersAPI::getInstance()->getUserPreferences($author, 'notify_pinned');
        if (!empty($getPref) && $getPref[0]->notify_pinned == 1)
            $this->addNotification(['receiver' => $author, 'action' => 3, 'action_id' => $thread]);
    }

    /**
     * @param $thread
     * @return mixed
     */
    public function getReplyNotify($thread)
    {
        return parent::selectData('id', ['action = 4', ['action_id' ,'=', $thread] ], $this->_table, null, 'LIMIT 1');
    }

    /**
     * @param $thread
     * @return mixed
     */
    public function getThankNotify($thread)
    {
        return parent::selectData('id', [ 'action = 5', ['action_id' ,'=', $thread] ], $this->_table, null, 'LIMIT 1');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function increaseStuck($id)
    {
        $getNotify = $this->getNotificationById($id, 'id');
        if (!empty($getNotify))
            return parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['stuck' => ['stuck + 1'], 'seen' => 0]);
    }

    /**
     * @param $thread
     * @return bool
     */
    public function notifyNewReply($thread)
    {
        $getThread = threadsAPI::getInstance()->getThreadByID($thread, 'author_id');
        if (empty($getThread))
            return false;
        $getThread = $getThread[0];
        $getPref = usersAPI::getInstance()->getUserPreferences($getThread->author_id, 'notify_replies');
        if (!empty($getPref) && $getPref[0]->notify_replies == 1)
        {
            $getNotify = $this->getReplyNotify($thread);
            if (empty($getNotify))
                $this->addNotification(['receiver' => $getThread->author_id, 'action' => 4, 'action_id' => $thread]);
            else
                $this->increaseStuck($getNotify[0]->id);
        }
    }

    /**
     * @param $thread
     * @return bool
     */
    public function notifyNewThank($thread)
    {
        $getThread = threadsAPI::getInstance()->getThreadByID($thread, 'author_id');
        if (empty($getThread))
            return false;
        $getThread = $getThread[0];
        $getPref = usersAPI::getInstance()->getUserPreferences($getThread->author_id, 'notify_thanks');
        if (!empty($getPref) && $getPref[0]->notify_thanks == 1)
        {
            $getNotify = $this->getThankNotify($thread);
            if (empty($getNotify))
                $this->addNotification(['receiver' => $getThread->author_id, 'action' => 5, 'action_id' => $thread]);
            else
                $this->increaseStuck($getNotify[0]->id);
        }
    }
}