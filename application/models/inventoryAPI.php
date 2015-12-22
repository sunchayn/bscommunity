<?php
/**
 * bloodstone community V1.0.0
 * inventoryAPI Class !
 * an API to manage users inventories
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class inventoryAPI extends databaseAPI
{
    /**
     * @var  string
     */
    private $_table = 'inventory',
            $_table2 = 'active_items';

    private static $_instance = null;

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new inventoryAPI(Controller::$db);
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

    /** get user inventory items
     * @param string $row
     * @param $user
     * @return mixed
     */
    public function getInventory($row = '*', $user)
    {
        return parent::selectData($row, [ ['user_id', '=', $user] ], $this->_table);
    }

    /** get the inventory items in pages
     * @param $user
     * @param string $row
     * @return $this
     */
    public function getInventoryPaginator($user, $row = "*")
    {
        $join = 'LEFT JOIN items ON inventory.item_id = items.id';
        return Paginator::getInstance()->getData([$this->_table, $join], "inventory", $row, [ ['user_id', '=', $user] ], null);
    }

    /** get an item form the inventory by id
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getItemById($id, $row = '*')
    {
        return parent::selectData($row, [ ['id', '=', $id] ], $this->_table);
    }

    /** get an items from the inventory of a given user
     * @param $item
     * @param $user
     * @param string $row
     * @return mixed
     */
    public function getItemFromInventory($item, $user, $row = '*')
    {
        return parent::selectData($row, [ ['item_id', '=', $item], ['user_id', '=', $user] ], $this->_table);
    }

    /** update the amount of an item in the inventory
     * @param $id
     * @param bool|true $increase
     * @return mixed
     */
    public function updateAmount($id, $increase = true)
    {
        if (!$increase && $this->getItemById($id, 'amount')[0]->amount == 1)
            return $this->deleteItem($id);
        return ($increase) ?
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['amount' => ['amount + 1']]):
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['amount' => ['amount - 1']]);
    }

    /** delete an item form the inventory
     * @param $id
     * @return mixed
     */
    public function deleteItem($id)
    {
        return parent::deleteData($this->_table, ['field'=> 'id', 'value' => $id]);
    }

    /** add an item to the inventory
     * @param $item
     * @param $user
     * @return bool|mixed
     */
    public function addItem($item, $user)
    {
        $issetItem = $this->getItemFromInventory($item,$user);
        if (!empty($issetItem))
            //increase the amount if the item exist
            return $this->updateAmount($issetItem[0]->id);
        //add the item
        return parent::insertData($this->_table, ['item_id', 'user_id'], [$item, $user]);
    }

    /** consume an item from the inventory
     * @param $item
     * @return array|bool|null|string
     */
    public function consumeItem($item)
    {
        Controller::$language->load('inventory');
        if (!usersAPI::isLogged())
            return false;
        $user = Controller::$GLOBAL['logged']->id;
        $issetItem = $this->getItemFromInventory($item, $user, 'id');
        if (!empty($issetItem))
        {
            $issetItem = $issetItem[0];
            $getItem = itemsAPI::getInstance()->getItemById($item);
            if (empty($getItem))
                return [Controller::$language->invokeOutput('wrong-item')];
            $getItem = $getItem[0];
            //if this item is a gain => consume without insert it the the active item
            if ($getItem->item_cat == 1)
            {
                $action = json_decode($getItem->item_action);
                switch($action[0])
                {
                    case 'xp' :
                        if (!usersAPI::getInstance()->addExperience($user ,$action[1])) return false;
                    break;
                }
                $this->updateAmount($issetItem->id, false);
                return Controller::$language->invokeOutput('consume-done');
            }else{
                if (parent::insertData($this->_table2, ['item_id', 'user_id', 'remain_use'], [$item, $user, $getItem->uses_number]))
                {
                    $this->updateAmount($issetItem->id, false);
                    return Controller::$language->invokeOutput('consume-done');
                }
                return false;
            }
        }else{
            return [Controller::$language->invokeOutput('wrong-select')];
        }
    }

    /** check if an active item owned by a given user
     * @param $item_id
     * @param $user
     * @return bool
     */
    public function issetActiveItem($item_id, $user)
    {
        return empty(parent::selectData('id', [ ['item_id', '=', $item_id], ['user_id', '=', $user] ], $this->_table2, null, 'LIMIT 1'));
    }

    /** get an active item
     * @param $item_id
     * @param $user
     * @return mixed
     */
    public function getActiveItem($item_id, $user)
    {
        if (is_array($item_id))
        {
            $whereInject = '`item_id` in (';
            foreach ($item_id as $id)
                $whereInject .= $id . ',';
            $whereInject = rtrim($whereInject, ',') . ')';
            return parent::selectData('id', [ $whereInject, ['user_id', '=', $user] ], $this->_table2, null, 'LIMIT 1');
        }
        return parent::selectData('id', [ ['item_id', '=', $item_id], ['user_id', '=', $user] ], $this->_table2, null, 'LIMIT 1');
    }

    /** get an active item by it's id
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getActiveItemById($id, $row = '*')
    {
        return parent::selectData($row, [ ['id', '=', $id] ], $this->_table2, null, 'LIMIT 1');
    }

    /** delete an active item
     * @param $id
     * @return mixed
     */
    public function deleteActiveItem($id)
    {
        return parent::deleteData($this->_table2, ['field'=> 'id', 'value' => $id]);
    }

    /** use an item from the active items
     * @param $id
     * @return mixed
     */
    public function useItem($id)
    {
        if ($this->getActiveItemById($id, 'remain_use')[0]->remain_use == 1)
            return $this->deleteActiveItem($id);
        return parent::updateData($this->_table2, ['field' => 'id', 'value' => $id], ['remain_use' => ['remain_use - 1']]);
    }
}