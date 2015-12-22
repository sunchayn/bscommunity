<?php
/**
 * bloodstone community V1.0.0
 * accessAPI Class !
 * an API for management access
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class filterAPI extends databaseAPI{

    /**
     * @var  string
     */
    private $_table = 'filter_list';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new filterAPI(Controller::$db);
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
     * @param $rows
     * @return mixed
     */
    function getWhiteList($rows = '*')
    {
        return parent::selectData($rows, ['is_black = 0'], $this->_table);
    }

    /**
     * @param $rows
     * @return mixed
     */
    function getBlackList($rows = '*')
    {
        return parent::selectData($rows, ['is_black = 1'], $this->_table);
    }

    /**
     * @return $this
     */
    function getWhiteListP()
    {
        return Paginator::getInstance()->getData($this->_table, null, "*", ['is_black = 0']);
    }

    /**
     * @return $this
     */
    function getBlackListP()
    {
        return Paginator::getInstance()->getData($this->_table, null, "*", ['is_black = 1']);
    }

    /**
     * @param $url
     * @return bool
     */
    function issetURL($url)
    {
        return (parent::selectData('count(*) as c', [['url', '=', $url]], $this->_table)[0]->c > 0);
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    function addEntry($data)
    {
        Controller::$language->load('admin_cp/validation/filter');
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['url','is_black'];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput("require")]];
        //get the URL
        if(!preg_match('/^(http(s)?:\/\/)?[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $data['url']))
            return ['url' => [Controller::$language->invokeOutput("invalidURL")]];
        $data['url'] = preg_replace('/^(http(s)?:\/\/)?(www.)?/', '', $data['url']);
        //set a valid is_black value
        $tmp = intval($data['is_black']);
        $data['is_black'] = ($tmp == 0 || $tmp == 1) ? $tmp : 1;
        //if the URL already exist
        if ($this->issetURL($data['url']))
            return ['url' => [Controller::$language->invokeOutput("url")]];
        //inset the URL
        return (parent::insertData($this->_table, $fieldsArray, array_values($data))) ? Controller::$language->invokeOutput("done") : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    function deleteEntry($id)
    {
        Controller::$language->load('admin_cp/validation/filter');
        return (parent::deleteData($this->_table, ['field' => 'id', 'value' => (int)$id])) ? Controller::$language->invokeOutput("deleteURL") : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    function turnWhite($id)
    {
        Controller::$language->load('admin_cp/validation/filter');
        return (parent::updateData($this->_table, ['field' => 'id', 'value' => (int)$id], ['is_black' => 0])) ? Language::invokeOutput('turnW') : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    function turnBlack($id)
    {
        Controller::$language->load('admin_cp/validation/filter');
        return (parent::updateData($this->_table, ['field' => 'id', 'value' => (int)$id], ['is_black' => 1])) ? Language::invokeOutput('turnB') : false;
    }

    /**
     * @param $url
     * @return bool
     */
    function isWhite($url)
    {
        $url =  preg_replace('/^(http(s)?:\/\/)?(www.)?/', '', $url);
        if (empty($url))
            return true;
        return (!empty(parent::selectData("*", [ ['url', '=', $url], 'is_black = 0' ], $this->_table)));
    }

    /**
     * @param $url
     * @return bool
     */
    function isBlack($url)
    {
        $url =  preg_replace('/^(http(s)?:\/\/)?(www.)?/', '', $url);
        if (empty($url))
            return false;
        return (!empty(parent::selectData("*", [ ['url', '=', $url], 'is_black = 1' ], $this->_table)));
    }

    /**
     * @param $url
     * @param int $mode
     * @return bool
     */
    function isBadURL($url, $mode = 0)
    {
        return ($mode == 0) ? !$this->isWhite($url) : $this->isBlack($url);
    }

}