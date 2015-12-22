<?php
/**
 * bloodstone community V1.0.0
 * itemsAPI Class !
 * an API to manage items buy and use
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class itemsAPI extends databaseAPI
{
    /**
     * @var  string
     */
    private $_table = 'items';

    private static $_instance = null;

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new itemsAPI(Controller::$db);
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
     * @param string $row
     * @param null $where
     * @return mixed
     */
    public function getItems($row = '*', $where = null)
    {
        return parent::selectData($row, $where, $this->_table);
    }

    /**
     * @param $id
     * @param $row
     * @return mixed
     */
    public function getItemById($id, $row = '*')
    {
        return parent::selectData($row, [ ['id', '=', $id] ], $this->_table);
    }

    /**
     * @param $cat
     * @param string $row
     * @return mixed
     */
    public function getItemsByCategory($cat, $row = '*')
    {
        return parent::selectData($row, ['cat_id', '=', $cat], $this->_table);
    }

    /**
     * @param $search
     * @param string $row
     * @return $this
     */
    public function getItemsPaginator($search, $row = '*')
    {
        if ($search === false)
            return Paginator::getInstance()->getData($this->_table, "store", $row, null, null);
        return Paginator::getInstance()->getData($this->_table, "store?search={$search}", $row, [ ['title_'.LANGUAGE_CODE, 'LIKE', "%".$search."%"] ], null, '&');
    }

    /**
     * @param $item
     * @return array|bool|null|string
     */
    public function buyItem($item)
    {
        Controller::$language->load('validation/store');
        //Controller::$language->load('validation/store');
        if (!usersAPI::isLogged())
            return [Controller::$language->invokeOutput('not-logged')];
        $user = Controller::$GLOBAL['logged']->id;
        $getCost = $this->getItemById(intval($item), 'cost');
        if (empty($getCost))
            return [Controller::$language->invokeOutput('wrongItem')];
        $getCost = $getCost[0]->cost;
        $userGold = Controller::$GLOBAL['logged']->gold;
        if ($getCost > $userGold)
            return [Controller::$language->invokeOutput('goldNotEnough')];
        if(inventoryAPI::getInstance()->addItem($item, $user))
        {
            //drain gold from user
            parent::updateData('users', ['field' => 'id', 'value' => $user], ['gold' => $userGold - $getCost]);
            return Controller::$language->invokeOutput('done');
        }
        return false;
    }
}