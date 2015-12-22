<?php
/**
 * bloodstone community V1.0.0
 * threadDraftAPI Class !
 * an API to handle threads drafts
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class threadDraftAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'threaddraft';
    private $session = 'BSCTDS';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new threadDraftAPI(Controller::$db);
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
     * @param string $rows
     * @param null $where
     * @return mixed
     */
    public function getDrafts($rows = "*", $where = null)
    {
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getUserDrafts($id, $rows = "*")
    {
        return $this->getDrafts($rows, [ ['author_id', '=', $id]]);
    }

    public function getUserDraftsP($id, $rows = "*")
    {
        return Paginator::getInstance()->getData($this->_table, "draft/see", $rows, [ ['author_id', '=', $id] ], null, '?');
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getDraftById($id, $rows = "*")
    {
        return parent::selectData($rows, [ ['id', '=', $id] ], $this->_table);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insertDraft($data = array())
    {
        if (!usersAPI::isLogged())
            return false;
        $data['author_id'] = usersAPI::getLoggedId();
        $data['attachments'] = isset($data['attachments']) && !empty($data['attachments']) ? 1 : 0;
        return parent::insertData($this->_table, array_keys($data), array_values($data));
    }

    /**
     * @param $id
     * @param array $data
     * @return array|bool|null|string
     */
    public function updateDraft($id, $data = array())
    {
        Controller::$language->load('validation/draft');
        $getDraft = $this->getDraftById($id);
        if (empty($getDraft))
            return false;
        $getDraft = $getDraft[0];
        //prevent user from affecting not owned drafts (by manipulating fields id)
        if ($getDraft->author_id != usersAPI::getLoggedId())
            return false;

        $update = parent::updateData($this->_table, ['field' => 'id', 'value' => $id], $data);
        //while this draft changed once, we have to delete it value from the session
        Session::destroy($this->session);
        return ($update) ? Language::invokeOutput('done') : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteDraft($id)
    {
        Controller::$language->load('validation/draft');
        return (parent::deleteData($this->_table, ['field' => 'id', 'value' => (int)$id])) ? language::invokeOutput('draft-delete') : false;
    }

    /**
     * @return bool
     */
    public function initDraft()
    {
        $getNotChangedDraft = Session::get($this->session);
        if ($getNotChangedDraft != false)
        {
            return $getNotChangedDraft;
        }else{
            $this->insertDraft(['content' => '','keywords' => '', 'title' => '']);
            $id = Controller::$db->lastInsertId();
            Session::set($this->session, $id);
            return $id;
        }
    }

    /**
     * @return mixed
     */
    public function clearUserOldDrafts()
    {

        if (!usersAPI::isLogged())
            return false;
        $id = (int)usersAPI::getLoggedId();
        return parent::deleteData($this->_table, ['`author_id` = '.$id.' and `date` < DATE_SUB(now(), INTERVAL 7 DAY)']);
    }
}