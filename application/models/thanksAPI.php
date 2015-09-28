<?php
/**
 * bloodstone community V1.0.0
 * thanksAPI Class !
 * an API to handle thanks for threads
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class thanksAPI extends databaseAPI
{
    /**
     * @var  string
     */
    private $_table = 'thanks';

    private static $_instance = null;

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new thanksAPI(Controller::$db);
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
     * @param string $rows
     * @param null $where
     * @return mixed
     */
    public function getThanks($rows = "*", $where = null)
    {
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param $thread
     * @return mixed
     */
    public function getThanksForThread($thread)
    {
        $join = "INNER JOIN users ON thanks.`thank_user` = users.`id`";
        return parent::selectData('thanks.*, users.username, users.level', [ ['thread_id', '=', $thread] ], [$this->_table, $join]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getThankedCount($id)
    {
        return $this->getThanks("count(*) as cnt", [ ['author_id', '=', $id] ])[0]->cnt;
    }


    /**
     * @param $id
     * @return int
     */
    public function getUserRank($id)
    {
        $sql = "SELECT DISTINCT
                    (SELECT
                            COUNT(*)
                        FROM
                            {$this->_table}
                        WHERE
                            author_id = {$id}) AS cnt,
                    COUNT(*) AS c
                FROM
                    {$this->_table} AS t
                GROUP BY t.author_id
                HAVING c >= cnt";
        return count(parent::executeQuery($sql));
    }

    /**
     * @param $thread
     * @param $thankU
     * @return bool
     */
    public function isAlreadyThank($thread, $thankU)
    {
        return (parent::selectData("count(*) as cnt", [ ['thread_id', '=', $thread], ['thank_user', '=', $thankU] ], $this->_table, null, 'LIMIT 1')[0]->cnt == 0 ) ? false : true;
    }

    /**
     * @param array $data
     * @return array|bool|string
     */
    public function addThank($data = [])
    {
        Controller::$language->load('validation/thanks');
        //set the required fields
        $requireData = ['thread_id','author_id'];
        //get the logged user id
        $data['thank_user'] = isset_get(Controller::$GLOBAL, 'loggedID', false);
        //get the array of fields
        $fieldsArray = array_keys($data);
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
           return [Controller::$language->invokeOutput("require")];
        if ( $this->isAlreadyThank($data['thread_id'], $data['thank_user']))
            return [Controller::$language->invokeOutput("already")];
        if ($data['author_id'] == $data['thank_user'])
            return [Controller::$language->invokeOutput("yourself")];
        if($data['thank_user'] === false)
            return [Controller::$language->invokeOutput("not-login")];
        // -- end check for errors
        //add the thank
        $thanks = parent::insertData($this->_table, $fieldsArray, array_values($data));
        if ($thanks)
        {
            //notify author
            notificationAPI::getInstance()->notifyNewThank(intval($data['thread_id']));
            return Controller::$language->invokeOutput("done");
        }
        return [language::invokeOutput('frequent/wrong')];
    }

}