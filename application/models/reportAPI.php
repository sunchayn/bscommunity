<?php
/**
 * bloodstone community V1.0.0
 * accessAPI Class !
 * an API to handel users reports
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class reportAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'report';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new reportAPI(Controller::$db);
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
     * @param string $row
     * @param null $where
     * @return mixed
     */
    public function getReports($row = '*', $where = null)
    {
        return parent::selectData($row, $where, $this->_table);
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getReportById($id, $rows = '*')
    {
        return parent::selectData($rows, [ ['id', '=', $id] ], $this->_table);
    }

    /**
     * @param null $where
     * @return $this
     */
    public function getReportsToCenter($where = null)
    {
        $order = Order::getOrder(true, null, 'BSCOSNR');
        $join = 'LEFT JOIN threads as t on t.id = report.reported
                LEFT JOIN replies on replies.id = report.reported
                LEFT JOIN threads on threads.id = replies.thread_id';
        return Paginator::getInstance()->getData([$this->_table, $join], 'report', 'count(report.reported) as nor, report.*, threads.`title`, t.title as TT', $where, 'group by `type`, `reported` ' .  $order);
    }

    /**
     * @param $reported
     * @param $type
     * @return mixed
     */
    public function getReportedPost($reported, $type)
    {
        if ($type == 0)
            return threadsAPI::getInstance()->getThreadByID($reported, 'title, content, id as TID');
        return repliesAPI::getInstance()->getReplyWithParent($reported, 'threads.title, replies.content, threads.id as TID');
    }

    /**
     * @param $reported
     * @param $type
     * @return mixed
     */
    public function getPostReports($reported, $type)
    {
        $join = 'LEFT JOIN users ON users.id = report.reporter';
        return parent::selectData( 'report.*, users.username, users.level, users.profile_picture', [ ['type', '=', $type], ['reported', '=', $reported] ], [$this->_table, $join]);
    }

    /**
     * @return mixed
     */
    public function getUnseenCount()
    {
        return parent::selectData('count (*) as c, DISTINCT reported', [ 'seen != 0' ], $this->_table)[0]->c;
    }

    /**
     * @return bool
     */
    public function issetUnread()
    {
        return !empty(parent::selectData('id', [ 'global_seen = 0' ], $this->_table, null, 'LIMIT 1'));
    }

    /**
     * @param $data
     * @return bool
     */
    public function isAlreadyReport($data)
    {
        return !empty(parent::selectData('id', [ ['type', '=',$data['type']], ['reported', '=', $data['reported']], ['reporter', '=', $data['reporter']] ], $this->_table, null, 'LIMIT 1'));
    }

    /**
     * @param $reported
     * @param $type
     * @return bool
     */
    public function isSeen($reported, $type)
    {
        return !empty(parent::selectData('id', [ ['type', '=',$type], ['reported', '=', $reported], 'global_seen = 0'], $this->_table, null, 'LIMIT 1'));
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function addReport($data = array())
    {
        Controller::$language->load('validation/report');
        if (!usersAPI::isLogged())
            return ['general' => [Controller::$language->invokeOutput("frequent/badLogin")]];
        $data['reporter'] = Controller::$GLOBAL['logged']->id;
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['type','content','reported'];
        //array that hold errors
        $errors = [];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            ['general' => [Controller::$language->invokeOutput("require")]];
        //if already report
        if ($this->isAlreadyReport($data))
            return ['general' => [Controller::$language->invokeOutput("already")]];
        //if thread doesn't exist
        switch($data['type'])
        {
            case 0 :
                if (!threadsAPI::getInstance()->isExist($data['reported']))
                    $errors['general'][] = Controller::$language->invokeOutput('thread1');
                break;
            case 1 :
                if (!repliesAPI::getInstance()->isExist($data['reported']))
                    $errors['general'][] = Controller::$language->invokeOutput('reply1');
                break;
            default :
                return false;
        }
        //format the content
        $data['content'] = trim($data['content']);
        //if report content is too short
        if (!isset($data['content'][6]))
            $errors['content'][] = Controller::$language->invokeOutput('content1');
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        //add the reply
        $add = parent::insertData($this->_table, $fieldsArray, array_values($data));
        if ($add)
        {
            //add xp gain
            usersAPI::getInstance()->addExperience($data['reporter'], 70);
            //add gold gain
            usersAPI::getInstance()->addGold($data['reporter'], 30);
            //return the succeed msg
            return Controller::$language->invokeOutput('done');
        }
        return false;
    }

    /**
     * @param $reported
     * @param $type
     * @return mixed
     */
    public function seeReports($reported, $type)
    {
        return parent::updateData($this->_table, ['field' => ['reported', 'type'], 'value' => [$reported, $type]], ['seen' => ['1'], 'global_seen' => ['1']]);
    }
}